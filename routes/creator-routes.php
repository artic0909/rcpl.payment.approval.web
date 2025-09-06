<?php

use App\Http\Controllers\CreatorController;
use Illuminate\Support\Facades\Route;


Route::get('/creator/login', [CreatorController::class, 'creatorLoginView'])->name('creator.login');
Route::get('/creator/register', [CreatorController::class, 'creatorRegisterView'])->name('creator.register');
Route::post('/creator/register', [CreatorController::class, 'creatorRegister'])->name('creator.register.store');
Route::post('/creator/login', [CreatorController::class, 'creatorLogin'])->name('creator.login.verify');


Route::middleware(['auth:creator'])->group(function () {
    Route::get('/creator/dashboard', [CreatorController::class, 'creatorDashboardView'])->name('creator.dashboard');
    Route::get('/creator/logout', [CreatorController::class, 'creatorLogout'])->name('creator.logout');

    Route::get('/creator/vendor-create', [CreatorController::class, 'creatorVendorCreateView'])->name('creator.vendor-create');
    Route::get('/creator/profile', [CreatorController::class, 'creatorProfileView'])->name('creator.profile');
    Route::post('/creator/profile', [CreatorController::class, 'creatorUpdateProfile'])->name('creator.profile.update');

});
