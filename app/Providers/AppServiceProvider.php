<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeTypeRepository;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\EmployeeTypeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(EmployeeRepositoryInterface::class,EmployeeRepository::class);
        
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(EmployeeTypeRepositoryInterface::class,EmployeeTypeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
