<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cakecontent;

class Cake extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_id',
        'cake_content',
        'cake_name',
        // 'cake_price',
        // 'cake_size',
      ];

      public function cakecontent()
    {
        return $this->hasMany(Cakecontent::class);
    }
}
