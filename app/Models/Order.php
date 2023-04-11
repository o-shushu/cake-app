<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'cake_content',
        'cake_name',
        'cake_category',
      ];

      public function carts()
      {
          return $this->hasMany(Cart::class,'order_id');
      }

      public function user()
    {
        return $this->belongsTo(User::class);
    }
}
