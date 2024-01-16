<?php

namespace App\Providers;

use App\Repositories\CategoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\RoleInterface;
use App\Repositories\RoleRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryInterface::class, CategoryRepository::class);
        $this->app->bind(RoleInterface::class, RoleRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
