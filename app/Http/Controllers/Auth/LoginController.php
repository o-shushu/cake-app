<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Residences;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    /**
     * Display the login view.
     */
// LoginPage
    public function showLoginPage()
    {
        return view('auth/login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if(!Auth::validate($credentials)):
            return redirect()->to('login')
                ->withErrors(trans('auth.failed'));
        endif;

        $user = Auth::getProvider()->retrieveByCredentials($credentials);

        Auth::login($user);

        return $this->authenticated($request, $user);
    }


// RegisterPage
    public function showRegisterPage(Request $request)
    {
        $residences = Residences::all();
        return view('auth/register', compact('residences'));
    }

    public function storeRegister()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|string',
            'password' => 'required',
            'tel' => 'required|numeric|digits_between:10,11',
            'residence' => 'required',
            'type' => 'required'
        ]);
        
        $user = User::create(request(['name', 'email', 'password', 'tel', 'residence', 'type']));
        
        auth()->login($user);
        
        // return redirect()->to('/games');
        return redirect('/register')->with('success', "Account successfully registered.");
    }

// ResetPasswordPage
    public function showResetPasswordPage()
    {
        return view('auth/reset-password');
    }
    
}
