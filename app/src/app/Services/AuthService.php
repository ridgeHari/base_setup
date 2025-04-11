<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;

class AuthService
{
    protected $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function attemptLogin($request)
    {
        $this->ensureLoginIsNotRateLimited($request);

        if ($this->authRepository->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return true;
        }

        throw ValidationException::withMessages([
            Fortify::username() => [trans('auth.failed')],
        ]);
    }

    protected function ensureLoginIsNotRateLimited($request)
    {
        $throttleKey = Str::lower($request->input(Fortify::username())) . '|' . $request->ip();

        RateLimiter::for('login', function ($request) use ($throttleKey) {
            return Limit::perMinute(5)->by($throttleKey);
        });

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            throw ValidationException::withMessages([
                Fortify::username() => [trans('auth.throttle', ['seconds' => RateLimiter::availableIn($throttleKey)])],
            ]);
        }

        RateLimiter::hit($throttleKey);
    }

    public function registerUser($request)
    {
        $user = $this->authRepository->createUser($request->only('name', 'email', 'password'));

        Auth::login($user);
    }
}
