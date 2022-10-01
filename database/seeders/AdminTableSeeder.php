<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admins\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminTableSeeder extends Seeder
{
    use RefreshDatabase;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Admin::factory()->count(10)->create();
    }
}
