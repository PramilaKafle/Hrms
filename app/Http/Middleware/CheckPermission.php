<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next ,$permissionName): Response
    {
        $user=Auth::user();

        if ($user && $user->is_superadmin) {
            return $next($request); 
        }
        
        if($user && $user->hasPermission($permissionName))
        {
            return $next($request);
        }
        else{
            return abort(403,'Unauthorized');
        }
    }
}
