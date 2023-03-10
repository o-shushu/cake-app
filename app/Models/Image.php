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
      public function users(){
      return $this->hasOne('App\Models\User', 'id', 'shop_id');
      }
  public function __construct()
  {
  //   $data = $this->get();
  //   dd($data);
  //   $email = session('email');
  //   $id = $this->where('email',$email)->get('id');
  //   dd($id);
  }
}
