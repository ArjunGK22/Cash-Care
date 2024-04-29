<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\LoanRepaymentController;
use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanApplicationsController;
use App\Http\Controllers\LoanApplicationStatusController;
use App\Http\Controllers\LoanPendingApplicationsController;
use App\Http\Controllers\RepaymentController;

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



Route::view('/','login');
Route::view('/dashboard','dashboard');

//Employee Operations Route
Route::resource('employees', UserController::class);

//Loan Application Routes
Route::resource('loans', LoanApplicationsController::class);
Route::get('/status/closed', [LoanApplicationsController::class, 'closed'])->name('loans.closed');

//Loan Status Routes
Route::resource('status', LoanApplicationStatusController::class);
Route::post('/status/disburse', [LoanApplicationStatusController::class, 'disburse'])->name('status.disburse');

//Loan Repayment Route
Route::resource('repayment',RepaymentController::class);

Route::prefix('/loans/repayment')->group(function(){

    Route::post('/',[LoanRepaymentController::class, 'repayment']);
    Route::post('/reschedule',[LoanRepaymentController::class, 'reschedule']);

});

//login route
Route::post('/login',[LoginController::class, 'login']);