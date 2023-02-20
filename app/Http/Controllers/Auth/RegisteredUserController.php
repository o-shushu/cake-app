<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisteredUserController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(){
       $attributes = request()->validate(
        [
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'tel'=>'required',
            'residence'=>'required',
            'type'=>'required'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        return request()->all();
    }
}
