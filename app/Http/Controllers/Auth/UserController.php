<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Residences;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Cake;

class UserController extends Controller
{
    //ユーザー情報表示、詳細、変更、保存
    public function userDetail(){

        $userInformation = User::all()->where('id', auth()->user()->id);
        foreach($userInformation as $item){
            $residence_id = $item->residence;
        }
        $residence = Residences::all()->where('id', $residence_id);
       return view('users/user-detail', compact('userInformation', 'residence'));
    }

    public function userUpdate(){
        $residences = Residences::all();
        $userInformation = User::all()->where('id', auth()->user()->id);
        foreach($userInformation as $item){
            $residence_id = $item->residence;
        }
        $residence = Residences::all()->where('id', $residence_id);
        return view('users/user-update', compact('userInformation', 'residence', 'residences'));
    }

    public function userStore(Request $request){

        $user_name = $request->input('name');
        $user_email = $request->input('email');
        $user_tel = $request->input('tel');
        $user_residence = $request->input('residence');
        User::where('id', auth()->user()->id)
        ->update(['name'=>$user_name, 'email'=>$user_email, 'tel'=>$user_tel, 'residence'=>$user_residence]) ;
        return redirect('user/detail');

    }

    public function userOrderPage($cakeId){

        $products = Cake::get()->where('id', $cakeId);
        $cakeImages = Image::get()->where('cake_id', $cakeId);
        foreach($cakeImages as $cakeImage){
            $cakeImagePath = $cakeImage->tmp_name;
        }
        return view('users/user-order', compact('products', 'cakeImagePath'));
    }
    
}
