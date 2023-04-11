<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cake;

class Cakecontent extends Model
{
    protected $table = 'cakecontent';
    protected $fillable = [
        'cake_price',
        'cake_size' ,
        'cake_id',
    ];

    // ここから下を記述
    public function cake()
    {
        return $this->belongsTo(Cake::class);
    }
}
