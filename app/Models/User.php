<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Emp_type;
use App\Models\Employee;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

   /**
         * The roles that belong to the User
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function roles()
        {
            return $this->belongsToMany(Role::class, 'role_user');
        }

        public function emp_types()
        {
            return $this->belongsToMany(Emp_type::class,'employees');
        }



        public function hasPermission($permissionName)
        {
             $permission = Permission::where('name',$permissionName )->first();
            return $this->roles()->whereHas('permissions', function ($query) use ($permission) {
                    $query->where('permissions.id', $permission->id);
                })->exists();
        }
    }

