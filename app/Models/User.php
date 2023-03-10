<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password','tel','residence','type'
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // public function residences(){
    //     return $this->belongsToMany('App\Models\Residences');
    //     // return $this->hasMany('App\Models\Residences', 'residence', 'id');
    // }

    // public function index(){
    //     $data = $this->get();
        
    //     foreach($data as $val){
    //         foreach($val->residences as $value){
    //             echo $value ->residence;
    //         }
    //     }
    // }
}
