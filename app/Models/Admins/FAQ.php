<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FAQ extends Model
{
    use
    HasFactory, HasTranslations;
    
    protected $guarded = [];
    public $translatable = ['question', 'answer'];
}
