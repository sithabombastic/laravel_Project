<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name_en',
        'name_kh',
        'description',
        'price',
        'image'
    ];
}
