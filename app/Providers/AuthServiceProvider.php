<?php

namespace App\Providers;

use App\Models\User;
use App\Models\LeaveRequest;
 use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

    Gate::define('hasEmployeeType', function (User $user) {
        return $user->emp_types()->exists();
    });
    Gate::define('hasleaveRequest',function($user)
    {
$empid=$user->emp_types()->first()->id;
$leaves =LeaveRequest::all()->pluck('emp_id');
return $leaves->contains($empid) ;

    });

  
  
    }
}
