<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Like;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password','tel','residence_id','type'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }
}
