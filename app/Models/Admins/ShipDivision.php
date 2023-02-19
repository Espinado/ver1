<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDivision extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'division_name',
        'status'
    ];
}
