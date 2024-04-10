<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\UserRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\EmployeeTypeRepository;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\EmployeeTypeRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;

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
        $this->app->bind(RoleRepositoryInterface::class,RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class,PermissionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
