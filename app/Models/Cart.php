<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function cakes()
    {
        return $this->hasMany(Cake::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    
    public function cake()
    {
        return $this->belongsTo(Cake::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function amount($cartSize,$cartCakeId)
    {
        return Cart::where('size',$cartSize)->where('cake_id',$cartCakeId)->sum('amount');
    }

    public function subtotal($cartSize,$cartCakeId)
    {
        return Cart::where('size',$cartSize)->where('cake_id',$cartCakeId)->sum('subtotal');
    }
}
