<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;

class Shop extends Model
{
    use HasFactory;

//営業ユーザは店舗を登録するかどうかをチェック
    public function checkShopId()
    {
        $userId = auth()->user()->id;
        $shopIds = $this->where('user_id', $userId)->exists();
        return $shopIds;
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'shop_id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'shop_id');
    }

    public function cakes()
    {
        return $this->hasMany(Cake::class, 'shop_id');
    }

    //後でViewで使う、いいねされているかを判定するメソッド。
    public function like_exist($userId,$shopId): bool {
        return Like::where('user_id', $userId)->where('shop_id', $shopId)->first() !==null;
       
    }
}
