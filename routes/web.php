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

// Pages routes
Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'index']);
Route::get('/employee', [App\Http\Controllers\HumanResourcesController::class, 'index']);
Route::get('/journal', [App\Http\Controllers\accountingController::class, 'index']);
Route::get('/general-ledger', [App\Http\Controllers\accountingController::class, 'generalLedger']);
Route::get('/partner-ledger', [App\Http\Controllers\accountingController::class, 'partnerLedger']);



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
Route::patch('/deleteJob', [App\Http\Controllers\HumanResourcesController::class, 'deleteJob'])->name('deleteJob.update');


Route::get('/editSchedule/{id}', [App\Http\Controllers\HumanResourcesController::class, 'editSchedule'])->name('editSchedule.edit');
Route::patch('/updateSchedule', [App\Http\Controllers\HumanResourcesController::class, 'updateSchedule'])->name('updateSchedule.update');
Route::patch('/deleteSchedule', [App\Http\Controllers\HumanResourcesController::class, 'deleteSchedule'])->name('deleteSchedule.update');

Route::get('/editDepartment/{id}', [App\Http\Controllers\HumanResourcesController::class, 'editDepartment'])->name('editDepartment.edit');
Route::patch('/updateDepartment', [App\Http\Controllers\HumanResourcesController::class, 'updateDepartment'])->name('updateDepartment.update');
Route::patch('/deleteDepartment', [App\Http\Controllers\HumanResourcesController::class, 'deleteDepartment'])->name('deleteDepartment.update');

// CRUD INVENTORY

Route::post('/addProduct', [App\Http\Controllers\InventoryController::class, 'storeProduct'])->name('addProduct.store');
Route::get('/editProduct/{id}', [App\Http\Controllers\InventoryController::class, 'editProduct'])->name('editProduct.edit');
Route::patch('/updateProduct', [App\Http\Controllers\InventoryController::class, 'updateProduct'])->name('updateProduct.update');
Route::patch('/deleteProduct', [App\Http\Controllers\InventoryController::class, 'deleteProduct'])->name('deleteProduct.update');


Route::post('/addCategory', [App\Http\Controllers\InventoryController::class, 'storeCategory'])->name('addCategory.store');
Route::get('/editCategory/{id}', [App\Http\Controllers\InventoryController::class, 'editCategory'])->name('editCategory.edit');
Route::patch('/updateCategory', [App\Http\Controllers\InventoryController::class, 'updateCategory'])->name('updateCategory.update');
Route::patch('/deleteCategory', [App\Http\Controllers\InventoryController::class, 'deleteCategory'])->name('deleteCategory.update');




