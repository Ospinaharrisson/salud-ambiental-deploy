<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\Admin\Auth\AuthService;

use App\Models\Shared\Home\Module;

class AdminController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login()
    {
        return view('Admin.auth.Login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if ($this->authService->login($credentials)) {
            return redirect()->route('admin.index');
        }

        return redirect()->route('login')->withErrors(['login' => 'Credenciales inválidas']);
    }

    public function logout(Request $request)
    {
        $this->authService->logoutWithSession($request);
        return redirect()->route('login');
    }

    public function adminIndexView()
    {
        return view('Admin.Components.Index.Main.main');
    }

    public function homeModuleView()
    {        
        return view('Admin.Components.Index.home');
    }


    public function themesModuleView(Module $module)
    {
        return view('admin.Components.Index.themes', compact('module'));
    }
}