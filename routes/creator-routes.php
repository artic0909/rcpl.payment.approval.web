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
    Route::get('/creator/vendor-create/edit/{id}', [CreatorController::class, 'creatorEditVendorView'])->name('creator.vendor-create.edit');
    Route::put('/creator/vendor-create/edit/{id}', [CreatorController::class, 'creatorVendorStore'])->name('creator.vendor-create.update');
    Route::post('/creator/vendor-create', [CreatorController::class, 'creatorVendorStore'])->name('creator.vendor-create.store');
    Route::delete('/creator/vendor-create/{id}', [CreatorController::class, 'creatorDeleteVendor'])->name('creator.vendor-create.delete');
    
    Route::get('/creator/site-code-create', [CreatorController::class, 'creatorSiteCodeView'])->name('creator.site-code-create');
    Route::post('/creator/site-code-create', [CreatorController::class, 'creatorSiteCode'])->name('creator.site-code-create.store');
    Route::put('/creator/site-code-create/{id}', [CreatorController::class, 'creatorUpdateSiteCode'])->name('creator.site-code-create.update');
    Route::delete('/creator/site-code-create/delete/{id}', [CreatorController::class, 'creatorDeleteSiteCode'])->name('creator.site-code-create.delete');
    Route::get('/creator/site-codes-export', [CreatorController::class, 'siteCodesExportAsExcel'])->name('creator.site-codes-export');

    
    Route::get('/creator/profile', [CreatorController::class, 'creatorProfileView'])->name('creator.profile');
    Route::post('/creator/profile', [CreatorController::class, 'creatorUpdateProfile'])->name('creator.profile.update');
    



});
