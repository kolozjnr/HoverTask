<?php

namespace App\Providers;

use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Repository\ITaskRepository;
use App\Repository\IUserRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use App\Repository\IProductRepository;
use App\Repository\ICategoryRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ITaskRepository::class, TaskRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
