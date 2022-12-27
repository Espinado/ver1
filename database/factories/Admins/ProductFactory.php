<?php

namespace Database\Factories\Admins;

use App\Models\Admins\Category;
use App\Models\Admins\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Sluggable\SlugOptions;
use LaravelLocalization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admins\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product_name=[];
        $product_details=[];
       foreach (LaravelLocalization::getSupportedLocales() as $key => $value) {
        $product_name[$key]= $this->faker->word(10);
            $product_details[$key]= $this->faker->sentence(10, 20);
        }
// dump($product_details);
// dd(json_encode($product_details));
        // $slug = str_slug($product_name);
        return [
            'product_name'                         => json_encode($product_name),
            'slug'                                 =>'1-2',
            'product_code'                         => $this->faker->ean13,
            'product_quantity'                     =>$this->faker->numberBetween(1,50),
            'product_details'                      => json_encode($product_details),
            'selling_price'                        =>$this->faker->randomFloat(2, 10,1000),
           'images'                                =>json_encode($this->faker->image($dir=public_path('/products'), 40, 40, 'cats')),
           'trumbnail'                             => $this->faker->image($dir = public_path('/products/trumbnails'), 100, 100, 'cats'),
           'category_id'                           => Category::all()->random()->id,
           'brand_id'                              =>  Brand::all()->random()->id,
           'status'                                => true
        ];
    }
}
