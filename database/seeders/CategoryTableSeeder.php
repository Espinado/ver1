<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admins\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(10)->hasChildren(10)->hasChildren(10)
            ->create();
    }
}
