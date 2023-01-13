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

Route::get('admin/users', function () {
    return view('users')->with('users', Users::all());
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/loginv2', [App\Http\Controllers\HomeController::class, 'logiv2']);
Route::get('/pointofsale', [App\Http\Controllers\PosController::class, 'index']);
Route::get('/crm', [App\Http\Controllers\CrmController::class, 'index']);


// Pages routes
Route::get('/inventory', [App\Http\Controllers\InventoryController::class, 'dashboard']);
Route::get('/payroll', [App\Http\Controllers\PayrollController::class, 'index']);
Route::get('/supplier', [App\Http\Controllers\InventoryController::class, 'supplierIndex']);
Route::get('/warehouse', [App\Http\Controllers\InventoryController::class, 'warehouseIndex']);
Route::get('/product', [App\Http\Controllers\InventoryController::class, 'index']);
Route::get('/employee', [App\Http\Controllers\HumanResourcesController::class, 'index']);
Route::get('/journal', [App\Http\Controllers\accountingController::class, 'index'])->name('journal');
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

// CRUD ACCOUNTING
Route::post('/addJournalEntry', [App\Http\Controllers\accountingController::class, 'storeJournalEntry'])->name('addJournalEntry.store');
// Route::post('/filterJournalEntry', [App\Http\Controllers\accountingController::class, 'index']);
Route::patch('/deleteJournal', [App\Http\Controllers\accountingController::class, 'deleteJournal'])->name('deleteJournal.update');
Route::get('/editJournal/{id}', [App\Http\Controllers\accountingController::class, 'editJournal'])->name('editJournal.edit');


// CRUD CASHADVANCE
Route::post('/addCashAdvance', [App\Http\Controllers\PayrollController::class, 'storeCashAdvance'])->name('addCashAdvance.store');
Route::get('/editCashAdvance/{id}', [App\Http\Controllers\PayrollController::class, 'editCashAdvance'])->name('editCashAdvance.edit');
Route::patch('/updateCashAdvance', [App\Http\Controllers\PayrollController::class, 'updateCashAdvance'])->name('updateCashAdvance.update');
Route::patch('/deleteCashAdvance', [App\Http\Controllers\PayrollController::class, 'deleteCashAdvance'])->name('deleteCashAdvance.update');

// CRUD DEDUCTION
Route::post('/addDeduction', [App\Http\Controllers\PayrollController::class, 'storeDeduction'])->name('addDeduction.store');
Route::get('/editDeduction/{id}', [App\Http\Controllers\PayrollController::class, 'editDeduction'])->name('editDeduction.edit');
Route::patch('/updateDeduction', [App\Http\Controllers\PayrollController::class, 'updateDeduction'])->name('updateDeduction.update');
Route::patch('/deleteDeduction', [App\Http\Controllers\PayrollController::class, 'deleteDeduction'])->name('deleteDeduction.update');
