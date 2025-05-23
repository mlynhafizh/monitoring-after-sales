<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AfterSalesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileMerchantController;


Route::get('/', function () {
    return view('welcome');
});

// Auth middleware group
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // After Sales
    Route::get('/after-sales/create', [AfterSalesController::class, 'create'])->name('after-sales.create');
    Route::post('/after-sales', [AfterSalesController::class, 'store'])->name('after-sales.store');
    Route::get('/after-sales/export', [AfterSalesController::class, 'export'])->name('after-sales.export');
    Route::get('/after-sales', [AfterSalesController::class, 'index'])->name('after-sales.index');
    Route::get('after-sales/{id}/edit', [AfterSalesController::class, 'edit'])->name('after-sales.edit');
    Route::put('after-sales/{id}', [AfterSalesController::class, 'update'])->name('after-sales.update');
    Route::delete('after-sales/{id}', [AfterSalesController::class, 'destroy'])->name('after-sales.destroy');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Profile Merchant
    Route::get('/profile-merchant', [ProfileMerchantController::class, 'index'])->name('profile-merchant.index');
    Route::get('/profile-merchant/create', [ProfileMerchantController::class, 'create'])->name('profile-merchant.create');
    Route::post('/profile-merchant', [ProfileMerchantController::class, 'store'])->name('profile-merchant.store');
    Route::get('/profile-merchant/export', [ProfileMerchantController::class, 'export'])->name('profile-merchant.export');
    Route::get('/profile-merchant/{id}/edit', [ProfileMerchantController::class, 'edit'])->name('profile-merchant.edit');
    Route::put('/profile-merchant/{id}', [ProfileMerchantController::class, 'update'])->name('profile-merchant.update');
    Route::delete('/profile-merchant/{id}', [ProfileMerchantController::class, 'destroy'])->name('profile-merchant.destroy');



});

// Route::resource('after-sales', AfterSalesController::class)->middleware('auth');

require __DIR__.'/auth.php';
