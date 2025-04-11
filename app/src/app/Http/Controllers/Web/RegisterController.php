<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\RegisterRequest;
use App\Services\AuthService;
use Inertia\Inertia;

class RegisterController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return Inertia::render('auth/Register');
    }

    public function store(RegisterRequest $request)
    {
        try {
            $this->authService->registerUser($request);
            return redirect('/');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => $e->getMessage()]);
        }
    }
}
