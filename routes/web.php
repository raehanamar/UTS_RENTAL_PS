<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('units', UnitController::class)->except('show');
Route::resource('customers', CustomerController::class)->except('show');
Route::resource('packages', PackageController::class)->except('show');
Route::resource('transactions', TransactionController::class)->except('show');