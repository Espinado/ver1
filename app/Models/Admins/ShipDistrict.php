<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipDistrict extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'district_name',
        'division_id',
        'status'
    ];

    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }

}
