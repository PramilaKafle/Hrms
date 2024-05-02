<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimesheetController;

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


Route::get('/redirect',[HomeController::class,'redirect']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::resource('employee', EmployeeController::class);
    Route::resource('/user',UserController::class);
    Route::resource('/role',RoleController::class);
  
    Route::resource('/leave',LeaveRequestController::class);
    Route::resource('/project',ProjectController::class);
    Route::resource('/timesheet',TimesheetController::class);

    Route::get('/assign',[EmployeeController::class,'projectassign'])->name('employee.assign');
    Route::post('/assign/store',[EmployeeController::class,'projectstore'])->name('employee.project');
    Route::get('/leave/approved/{id}',[LeaveRequestController::class,'approve'])->name('leave.approve');
    Route::get('/leave/declined/{id}',[LeaveRequestController::class,'decline'])->name('leave.decline');

    Route::group(['prefix' => 'projectdash'], function () {
        Route::get('/', [ProjectController::class, 'dashboard'])->name('project.dashboard');
        Route::get('/{project}', [ProjectController::class, 'getProject'])->name('project.selected');

        Route::group(['prefix' => '{project}/timesheet'], function () {
            Route::get('/', [TimesheetController::class, 'create'])->name('timesheet.create');
            Route::post('/store-data', [TimesheetController::class, 'store'])->name('timesheet.store');
            Route::get('/get-data', [TimesheetController::class, 'gettimesheetdata'])->name('timesheet.getdata');
            Route::post('/delete-data', [TimesheetController::class, 'deletedata'])->name('timesheet.deletedata');
        });
    });
  
});



require __DIR__.'/auth.php';
