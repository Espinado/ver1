<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admins\Brand;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::factory()->count(10)->create();
    }
}
