<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(){
       $attributes = request()->validate(
        [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tel'=>'required',
            'residence'=>'required',
            'type'=>'required'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        return request()->all();
    }
}
