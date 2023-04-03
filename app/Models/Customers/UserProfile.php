<?php

namespace App\Models\Customers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function division()
    {
        return $this->belongsTo('App\Models\Admins\ShipDivision', 'division_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo('App\Models\Admins\ShipDistrict', 'district_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo('App\Models\Admins\ShipState', 'state_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
