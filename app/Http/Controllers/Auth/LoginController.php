<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
    public function showLoginPage()
    {
        return view('auth/login');
    }

    public function showRegisterPage()
    {
        return view('auth/register');
    }

    public function showResetPasswordPage()
    {
        return view('auth/reset-password');
    }
    public function showProductPage()
    {
        return view('product');
    }
}
