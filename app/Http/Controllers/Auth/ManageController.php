<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Like;
use App\Models\Residence;

class ManageController extends Controller
{
//会員ユーザー一覧
    public function consumersIndexPage()
    {
        $users = User::where('type',1)->with('residence')->paginate(10);
        return view('manager/manage-users',compact('users'));
    }

//営業ユーザー一覧
    public function shopkeepersIndexPage()
    {
        $user = 'shopkeepers';
        $users = User::where('type',2)->paginate(10);
        return view('manager/manage-users',compact('users','user'));
    }

//ユーザー編集
    public function consumersUpdatePage($userId)
    {
        $residences = Residence::all();
        $userInformation = User::all()->where('id', $userId);
        foreach($userInformation as $item){
            $residence_id = $item->residence_id;
        }
      
        $residence = Residence::all()->where('id', $residence_id);

        return view('users/user-update', compact('userInformation', 'residence', 'residences'));
    }

//ユーザー削除
    public function deleteUser($userId)
    {
         User::where('id', $userId)->delete();
         return back();
    }

//店舗いいね一覧
    public function shopLikesIndex()
    {
        $shops = Like::select(Like::raw('shop_id, count(*) as total'))->whereNotNull('shop_id')
        ->orderBy('total', 'desc')
        ->groupBy('shop_id')->with('shop')->paginate(10);
        $like = 'shops';
        
        return view('manager/manage-likes',compact('shops','like'));
    }

//商品いいね一覧
    public function cakeLikesIndex(){
        $shops = Like::select(Like::raw('cake_id, count(*) as total'))->whereNotNull('cake_id')
        ->orderBy('total', 'desc')
        ->groupBy('cake_id')->with('cake','cake.shop')->paginate(10);

        return view('manager/manage-likes',compact('shops'));
    }

}
