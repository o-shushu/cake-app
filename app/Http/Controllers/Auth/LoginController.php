<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
         // $_SERVER->サーバー変数であり、ヘッダ情報やパス情報等を格納しており、この情報はウェブサーバーに依存している->前の画面のリンクを格納している'HTTP_REFERER'や各種サーバーの情報が入っている
       // $_SERVERに'HTTP_REFERER'(前のページのURLを保存する項目)が存在していたら
        // if (array_key_exists('HTTP_REFERER', $_SERVER)) {
        //     $path = parse_url($_SERVER['HTTP_REFERER']); //parse_url-> URL を解釈し、その構成要素(schemeやhost、pass等)を配列で返す

        //     if (array_key_exists('host', $path)) {  // ホスト部分どうし(リクエストヘッダーのホストとアプリケーションが存在するサーバーのホスト($_SERVER['HTTP_HOST']で取得可能))で比較する。
        //         if ($path['host'] == $_SERVER['HTTP_HOST']) {
        //             //sessionに前回のURLを入れておく->下記のredirectPathアクションで使用する
        //             session(['url.intended' => $_SERVER['HTTP_REFERER']]);
        //         }
        //     }
        // }
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
            $email = $request->input('email');
            session(['email' => $email]);
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
