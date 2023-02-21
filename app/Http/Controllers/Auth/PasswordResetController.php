<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class PasswordResetController extends Controller
{
    public function create(): View
    {
        return view('auth.reset-password');
    }
}
