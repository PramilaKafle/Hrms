<?php

namespace App\Models;

use app\Models\User;
use App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

   /**
         * The roles that belong to the Role
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         */
        public function users()
        {
            return $this->belongsToMany(User::class,'role_user');
        }

        public function permissions()
        {
            return $this->belongsToMany(Permission::class,'role_permission');
        }
    }

