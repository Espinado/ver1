<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipState extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $fillable = [
        'state_name',
        'division_id',
        'district_id',
        'status'
    ];
    public function division()
    {
        return $this->belongsTo(ShipDivision::class, 'division_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo(ShipDistrict::class, 'district_id', 'id');
    }
}
