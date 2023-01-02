<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/loginv2', [App\Http\Controllers\HomeController::class, 'logiv2']);



Route::get('/employee', [App\Http\Controllers\HumanResourcesController::class, 'index']);

// CRUD HUMAN RESOURCESphoto.store
Route::post('/addSchedule', [App\Http\Controllers\HumanResourcesController::class, 'storeSchedule'])->name('addSchedule.store');
Route::post('/addJob', [App\Http\Controllers\HumanResourcesController::class, 'storeJob'])->name('addJob.store');
Route::post('/addDepartment', [App\Http\Controllers\HumanResourcesController::class, 'storeDepartment'])->name('addDepartment.store');
Route::post('/addEmployee', [App\Http\Controllers\HumanResourcesController::class, 'storeEmployee'])->name('addEmployee.store');

Route::get('/editEmployee/{id}', [App\Http\Controllers\HumanResourcesController::class, 'editEmployee'])->name('editEmployee.edit');
Route::patch('/updateEmployee', [App\Http\Controllers\HumanResourcesController::class, 'updateEmployee'])->name('updateEmployee.update');
Route::patch('/deleteEmployee', [App\Http\Controllers\HumanResourcesController::class, 'deleteEmployee'])->name('deleteEmployee.update');

Route::get('/editJob/{id}', [App\Http\Controllers\HumanResourcesController::class, 'editJob'])->name('editJob.edit');
Route::patch('/updateJob', [App\Http\Controllers\HumanResourcesController::class, 'updateJob'])->name('updateJob.update');







