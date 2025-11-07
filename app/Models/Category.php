<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     protected $fillable = [
        'sku',
        'barcode',
        'name_en',
        'name_kh',
        'price',
        'image'
    ];
}
