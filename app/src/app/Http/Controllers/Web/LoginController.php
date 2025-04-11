<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Services\AuthService;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    protected $authService;
    protected $guard;

    public function __construct(StatefulGuard $guard, AuthService $authService)
    {
        $this->guard = $guard;
        $this->authService = $authService;
    }

    public function index()
    {
        return Inertia::render('auth/Login');
    }

    public function store(LoginRequest $request)
    {
        try {
            $this->authService->attemptLogin($request);
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request)
    {
        $this->guard->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->intended('login');
    }
}
