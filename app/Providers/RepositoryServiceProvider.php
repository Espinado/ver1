<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AdminRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Interfaces\BrandRepositoryInterface;
use App\Repositories\BrandRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
