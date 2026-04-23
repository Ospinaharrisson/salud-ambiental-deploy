<?php

namespace App\Services\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthService
{
    public function login(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function logoutWithSession(Request $request): void
    {
        $this->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }

    public function isAuthenticated(): bool
    {
        return Auth::check();
    }

    public function user()
    {
        return Auth::user();
    }
}
