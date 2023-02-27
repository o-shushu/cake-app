<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class ProductController extends Controller
{
        public function showProductPage()
    {
        return view('product');
    }

}
