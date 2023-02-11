<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $quarded=[];

    public function product()
    {
        return $this->belongsTo('App\Models\Admins\Product', 'product_id', 'id');
    }
}
