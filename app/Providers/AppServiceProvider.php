<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\BaseRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\RoleRepository;

use App\Repositories\LeaveRepository;

use App\Interfaces\BaseRepositoryInterface;
// use App\Interfaces\EmployeeRepositoryInterface;
// use App\Interfaces\EmployeeTypeRepositoryInterface;
// use App\Interfaces\RoleRepositoryInterface;
// use App\Interfaces\PermissionRepositoryInterface;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

     
        
        $this->app->bind(BaseRepositoryInterface::class,BaseRepository::class);
   
      
         $this->app->bind(BaseRepositoryInterface::class,LeaveRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
