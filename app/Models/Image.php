<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
