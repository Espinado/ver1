<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
     use HasFactory;


    protected $fillable = [
        'product_id',
        'photo_name'
    ];
}
