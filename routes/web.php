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
Route::get('/employee', [App\Http\Controllers\HumanResourcesController::class, 'index'])->name('employee');
Route::get('/accounting', [App\Http\Controllers\accountingController::class, 'dashboard'])->name('dashboard');
Route::get('/account', [App\Http\Controllers\accountingController::class, 'account'])->name('account');
Route::get('/registration', [App\Http\Controllers\HumanResourcesController::class, 'registration']);




// CRUD HUMAN RESOURCES
Route::post('/addSchedule', [App\Http\Controllers\HumanResourcesController::class, 'storeSchedule'])->name('addSchedule.store');
Route::post('/addJob', [App\Http\Controllers\HumanResourcesController::class, 'storeJob'])->name('addJob.store');
Route::post('/addDepartment', [App\Http\Controllers\HumanResourcesController::class, 'storeDepartment'])->name('addDepartment.store');
Route::post('/addEmployee', [App\Http\Controllers\HumanResourcesController::class, 'storeEmployee'])->name('addEmployee.store');

Route::get('/editEmployee/{id}', [App\Http\Controllers\HumanResourcesController::class, 'editEmployee'])->name('editEmployee.edit');
Route::get('/profileEmployee/{id}', [App\Http\Controllers\HumanResourcesController::class, 'profileEmployee'])->name('profileEmployee.edit');
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

Route::post('/addWarehouse', [App\Http\Controllers\InventoryController::class, 'storeWarehouse'])->name('addWarehouse.store');
Route::get('/editWarehouse/{id}', [App\Http\Controllers\InventoryController::class, 'editWarehouse'])->name('editWarehouse.edit');
Route::patch('/updateWarehouse', [App\Http\Controllers\InventoryController::class, 'updateWarehouse'])->name('updateWarehouse.update');
Route::patch('/deleteWarehouse', [App\Http\Controllers\InventoryController::class, 'deleteWarehouse'])->name('deleteWarehouse.update');



// CRUD ACCOUNTING
Route::post('/addJournalEntry', [App\Http\Controllers\accountingController::class, 'storeJournalEntry'])->name('addJournalEntry.store');
Route::patch('/deleteJournal', [App\Http\Controllers\accountingController::class, 'deleteJournal'])->name('deleteJournal.update');
Route::get('/editJournal/{id}', [App\Http\Controllers\accountingController::class, 'editJournal'])->name('editJournal.edit');
Route::patch('/updateJournal', [App\Http\Controllers\accountingController::class, 'updateJournal'])->name('updateJournal.update');


Route::post('/addAccountList', [App\Http\Controllers\accountingController::class, 'addAccountList'])->name('addAccountList.store');
Route::get('/editAccountList/{id}', [App\Http\Controllers\accountingController::class, 'editAccountList'])->name('editAccountList.edit');
Route::patch('/updateAccountList', [App\Http\Controllers\accountingController::class, 'updateAccountList'])->name('updateAccountList.update');
Route::patch('/deleteAccountList', [App\Http\Controllers\accountingController::class, 'deleteAccountList'])->name('deleteAccountList.update');

Route::post('/addGroupList', [App\Http\Controllers\accountingController::class, 'storeGroupList'])->name('addGroupList.store');
Route::get('/editGroupList/{id}', [App\Http\Controllers\accountingController::class, 'editGroupList'])->name('editGroupList.edit');
Route::patch('/updateGroupList', [App\Http\Controllers\accountingController::class, 'updateGroupList'])->name('updateGroupList.update');
Route::patch('/deletegroupList', [App\Http\Controllers\accountingController::class, 'deletegroupList'])->name('deletegroupList.update');

Route::post('/addBankAccount', [App\Http\Controllers\accountingController::class, 'storeBankAccount'])->name('addBankAccount.store');
Route::get('/editBankAccount/{id}', [App\Http\Controllers\accountingController::class, 'editBankAccount'])->name('editBankAccount.edit');
Route::patch('/updateBankAccount', [App\Http\Controllers\accountingController::class, 'updateBankAccount'])->name('updateBankAccount.update');
Route::patch('/deleteBankList', [App\Http\Controllers\accountingController::class, 'deleteBankList'])->name('deleteBankList.update');


// ACCOUNTING REPORTS
Route::get('/journal', [App\Http\Controllers\accountingController::class, 'index'])->name('journal');
Route::get('/general-ledger', [App\Http\Controllers\accountingController::class, 'generalLedger']);
Route::get('/partner-ledger', [App\Http\Controllers\accountingController::class, 'partnerLedger']);
Route::get('/trial-balance', [App\Http\Controllers\accountingController::class, 'trialBalance']);
Route::get('/income-statement', [App\Http\Controllers\accountingController::class, 'incomeStatement']);
Route::get('/balance-sheet', [App\Http\Controllers\accountingController::class, 'balanceSheet']);


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
