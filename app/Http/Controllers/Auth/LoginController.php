<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Residences;

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

    public function actionLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
       
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->to('/');
        }

        return back()->withErrors([
            'message' => 'メールアドレス又はパスワードが正しくありません。',
        ])->onlyInput('email');
    
    }



// RegisterPage
    public function showRegisterPage()
    {
        $residences = Residences::all();
        return view('auth/register', compact('residences'));
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|string',
            'password' => 'required|confirmed|string|min:8',
            'tel' => 'required|numeric|digits_between:10,11',
            'residence' => 'required',
            'type' => 'required'
        ]);
        
        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => $request->password,
            'tel' => $request->tel, 
            'residence' => $request->residence, 
            'type' => $request->type,
        ]);
        
        
        $messageRegister= '新規登録完了しました。ログインしてください。';

        // return redirect()->to('/games');
        $residences = Residences::all();
        return view('auth/register', compact('residences', 'messageRegister'));
    }
//Logout
    public function actionLogout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect()->to('/');
    }
// ResetPasswordPage
    public function showResetPasswordPage()
    {
        return view('auth/reset-password');
    }
    
}
