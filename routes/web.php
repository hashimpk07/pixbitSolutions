<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DesignationsController;
use App\Http\Controllers\EmployeeController;
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
    return view('auth.login');
});

// Login  Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

//Designations  Routes
Route::get('designations', [DesignationsController::class, 'index'])->name('designations');
Route::post('designations.store',[DesignationsController::class, 'store'])->name('designations.create');
Route::get('designations/add',[DesignationsController::class, 'create'])->name('designations.add');
Route::get('designations.edit/{id}',[DesignationsController::class, 'edit'])->name('designations.edit');
Route::post('designations.update',[DesignationsController::class, 'update'])->name('designations.update');
Route::get('designations.delete/{id}',[DesignationsController::class, 'destroy'])->name('designations.delete');

//Employee  Routes
Route::get('employees', [EmployeeController::class, 'index'])->name('employees');
Route::post('employees.store',[EmployeeController::class, 'store'])->name('employees.create');
Route::get('employees/add',[EmployeeController::class, 'create'])->name('employees.add');
Route::get('employees.edit/{id}',[EmployeeController::class, 'edit'])->name('employees.edit');
Route::post('employees.update',[EmployeeController::class, 'update'])->name('employees.update');
Route::get('employees.delete/{id}',[EmployeeController::class, 'destroy'])->name('employees.delete');
