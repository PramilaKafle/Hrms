<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LeaveRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/redirect',[HomeController::class,'redirect']);

Route::middleware('auth')->group(function () {
    // Route::get('/create',[EmployeeController::class,'create'])->name('employee.create');
    // Route::post('/store',[EmployeeController::class,'store'])->name('employee.store');
    // Route::get('/view',[EmployeeController::class,'index'])->name('employee.view');
    // Route::get('/view/{id}/edit',[EmployeeController::class,'edit'])->name('employee.edit');
    // Route::patch('/view/{id}/update',[EmployeeController::class,'update'])->name('employee.update');
    // Route::delete('/view/{id}',[EmployeeController::class,'destroy'])->name('employee.destroy');

    Route::resource('employee', EmployeeController::class);
    Route::get('/leave',[LeaveRequestController::class,'create'])->name('leaverequest.create');
    Route::get('/assignrole',[RoleController::class,'create'])->name('assign.role');
 
});
   








require __DIR__.'/auth.php';
