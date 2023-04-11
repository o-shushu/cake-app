<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Shop;

class LikeController extends Controller
{
//店舗にいいねを付け
    public function shopLike(Request $request)
    {
        $data = $request->validate([
            'shop_id' => 'required',
        ]);

        $user_id = auth()->id();
       
        $already_liked = Like::where('user_id', $user_id)->where('shop_id', $data['shop_id'])->first();
        if(is_null($already_liked)){
            Like::create([
                'shop_id' => $data['shop_id'],
                'user_id' => $user_id
            ]);
            return response('liked', 200);
        }

        if(!is_null($already_liked)){
            $already_liked->delete();
            return response('unliked', 200);
        }

        return response('Error', 200);
    }

//商品にいいねを付け
    public function cakeLike(Request $request)
    {
        $data = $request->validate([
            'cake_id' => 'required',
        ]);

        $user_id = auth()->id();
       
        $checkHaveShop = Shop::where('user_id', $user_id)->first();
        $already_liked = Like::where('user_id', $user_id)->where('cake_id', $data['cake_id'])->first();

        if(is_null($already_liked) && is_null($checkHaveShop)){
            Like::create([
                'cake_id' => $data['cake_id'],
                'user_id' => $user_id
            ]);
            $cake_likes = Like::where('cake_id', $data['cake_id'])->count();
            
            return response(['status'=> 'liked', 'total_likes' => $cake_likes], 200);  
        }

        if(!is_null($already_liked)){
            $already_liked->delete();
            $cake_likes = Like::where('cake_id', $data['cake_id'])->count();
            return response(['status'=> 'unliked', 'total_likes' => $cake_likes], 200);
        }

        return response('Error', 200);
    }
}
