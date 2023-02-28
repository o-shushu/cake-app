<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Image;

class ProductController extends Controller
{
        public function showProductPage()
    {
        return view('products/product');
    }

    public function index(){

    	return view('products/insertproduct');
    }

    public function store(Request $request){
        // ディレクトリ名,app>storage>app>public>sample
    $dir = 'insertProducts';

    // アップロードされたファイル名を取得
    $file_name = $request->file('image')->getClientOriginalName();

   // 取得したファイル名で保存
   $request->file('image')->storeAs('public/' . $dir, $file_name);

   // ファイル情報をDBに保存
   $image = new Image();
   $image->image_name = $file_name;
   $image->tmp_name = 'storage/' . $dir . '/' . $file_name;
   $image->save();
    return redirect('/');
        }

public function upload(Request $request){
    
}
    public function insert(){

    }
}
