<?php

namespace Database\Factories\Admins;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $arr = [];

        foreach (LaravelLocalization::getSupportedLocales() as $code => $prop) {
            $arr[$code]  = $this->faker->word(10,);
        }

        return [

            'slug'=>$arr['en'],
            'category_name' => json_encode($arr),
        ];
    }
}
