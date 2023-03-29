<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Image extends Model
{
    public $timestamps = false;

    protected $fillable = [
      'cake_id',
      'shop_id',
      'image_name',
      'image_type',
      'tmp_name',
      'image_size',
    ];

    public function users()
    {
      return $this->hasOne('App\Models\User', 'id', 'shop_id');
    }

    //店の画像を取得する
    public function scopeShopImages($query)
    {
      return $query->where('cake_id', 0);
    }
}
