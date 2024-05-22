<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/count', [HomeController::class,'index'])->name('count');
Route::get('/users/{id}',[HomeController::class,'getUser'])->name('getUser');

// roles react route

 Route::get('/roles',[RoleController::class,'getRoles'])->name('roles.index');
 Route::get('roles/create',[RoleController::class,'create'])->name('roles.create');
 Route::get('roles/{id}',[RoleController::class,'show'])->name('roles.show');

 Route::post('/roles/store',[RoleController::class,'store'])->name('roles.store');
 Route::put('/roles/{id}',[RoleController::class,'update'])->name('roles.update');

 Route::delete('/roles/{id}',[RoleController::class,'destroy'])->name('role.delete');