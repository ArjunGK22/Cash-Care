<?php

use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanRepaymentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserCreateController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
});


Route::view('/dashboard','dashboard');

//Admin Controllers
Route::get('/employees',[UserCreateController::class,'view']); //add employee
Route::post('/create/employee',[UserCreateController::class, 'saveEmployee']);


//Create Loan Application and update the status
Route::post('/create/loan',[LoanApplicationController::class, 'saveApplication']);
Route::post('/loans/update',[LoanApplicationController::class, 'updateApplication']); //update loan application - disbursemnt

// view Loan Applications 
Route::get('/loans/applications',[LoanApplicationController::class, 'viewApplications']);

// View loan repayments 
Route::get('/loans/repayment',[LoanRepaymentController::class,'view']); //create a new application
Route::get('/loans/repayment/{loanid}',[LoanRepaymentController::class, 'loanRepaymentView']);//fetch individual repayments


Route::post('/loans/repayment',[LoanRepaymentController::class, 'repayment']);
Route::post('/loans/repayment/reschedule',[LoanRepaymentController::class, 'reschedule']);

Route::get('/loans/test',[LoanApplicationController::class, 'test']); //test

Route::get('loans/accept/{loanid}',[LoanApplicationController::class, 'accept']); //accept
Route::get('loans/reject/{loanid}',[LoanApplicationController::class, 'reject']); //reject
Route::get('loans/cancel/{loanid}',[LoanApplicationController::class, 'cancel']); //cancel


Route::get('/loans',[LoanApplicationController::class,'viewActiveApplications']); //create a new application
Route::get('/loans/{loanid}',[LoanApplicationController::class,'viewActiveApplication']);



//login route
Route::post('/login',[LoginController::class, 'login']);