<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {   
        //email:filter防止输入平假名、片假名和汉字
        //检查输入的电子邮件地址是否已在用户表中注册
        return [
            'email' => 'required|email:filter|exists:users,email'
        ];
    }
    
    // バリデーションメッセージのカスタマイズ
    public function messages()
    {
        return [
            'email.required' => ':attributeを入力してください',
            'email.email' => '正しいメールアドレスの形式で入力してください',
            'email.exists' => '登録している:attributeを入力してください'
        ];
    }

    // attribute名をカスタマイズ
    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
        ];
    }
}
