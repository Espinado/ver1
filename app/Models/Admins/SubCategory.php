<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class SubCategory extends Model
{

    use
        HasFactory,
        HasSlug;

    protected $fillable = [
        'subcategory_name',
        'category_id',
        'slug',
        'icon'
    ];
    use HasTranslations;

    public $translatable = ['subcategory_name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('subcategory_name')
            ->saveSlugsTo('slug');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
