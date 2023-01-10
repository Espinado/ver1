<?php

namespace App\Models\Admins;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;


class Product extends Model
{
    use HasFactory, HasSlug;
   

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'brand_id',
        'product_name',
        'slug',
        'product_code',
        'product_qty',
        'product_tags',
        'product_size',
        'short_description',
        'long_description',
        'product_color',
        'selling_price',
        'discount_price',
        'images',
        'status',
        'product_thambnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('product_name')
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
