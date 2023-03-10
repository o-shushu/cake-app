<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    public function checkShopId(){
        $userId = auth()->user()->id;
        $shopIds = $this->where('user_id', $userId)->exists();
        return $shopIds;
    }
}
