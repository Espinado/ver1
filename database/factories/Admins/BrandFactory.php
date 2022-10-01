<?php

namespace Database\Factories\Admins;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;


class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


    return [
            'brand_name' => $this->faker->word(10),
            'brand_logo' => $this->faker->image(public_path('brands'), $width = 640, $height = 480)

        ];

    }
}
