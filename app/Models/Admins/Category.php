<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;


class Category extends Model
{
    private $descendants = [];
    use
        HasFactory,
        HasSlug;

    protected $fillable = [
        'category_name',
        'parent_id',
        'slug',
        'icon'
    ];
    use HasTranslations;

    public $translatable = ['category_name'];




    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    public function parentRecursive()
    {
        return $this->parent()->with('parentRecursive');
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('category_name')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
