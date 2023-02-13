<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'coupon_name',
        'coupon_discount',
        'coupon_validity',
        'status'
    ];
}
