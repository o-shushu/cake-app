<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cakecontent;
use App\Models\Like;

class Cake extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'cake_content',
        'cake_name',
        'cake_category',
      ];

      public function cakecontent()
    {
        return $this->hasMany(Cakecontent::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'cake_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'cake_id');
    }
   
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function detail(){
        $data = $this->get();
        foreach($data as $val){
            foreach($val->cakecontent as $value){
                return $value->cake_size.'<br/>';
            }
        }
    }

//後でViewで使う、いいねされているかを判定するメソッド。
    public function like_exist($userId,$cakeId): bool {
        $checkHaveShop = Shop::where('user_id', $userId)->first();
        if(!is_null($checkHaveShop)){
            return false;
        }
        return Like::where('user_id', $userId)->where('cake_id', $cakeId)->first() !==null;
       
    }
}
