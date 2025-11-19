<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:staff'])->group(function () {

    Route::get('/staff/staff-payment-form', [FrontController::class, 'staffPaymentFormView'])->name('staff.staff-payment-form');

    Route::get('/staff/get-site-details/{siteCode}', [FrontController::class, 'getSiteDetails'])->name('staff.get-site-details');

    Route::post('/staff/staff-payment-form', [FrontController::class, 'staffPaymentForm'])->name('staff.staff-payment-form.store');
    Route::get('/staff/staff-profile', [FrontController::class, 'staffProfileView'])->name('staff.staff-profile');
    Route::post('/staff/staff-logout', [FrontController::class, 'logoutStaff'])->name('staff.logout');
    Route::get('/staff/payment-pdf/{id}', [FrontController::class, 'paymentPdfDownload'])->name('staff.payment.pdf');
    Route::post('/staff/profile/update', [FrontController::class, 'profileUpdate'])->name('staff.profile.update');

    Route::get('/staff/{id}/edit', [FrontController::class, 'staffPaymentFormEdit'])->name('stuff.stuff-payment-form.edit');
    Route::post('/staff/{id}/update', [FrontController::class, 'staffPaymentFormUpdate'])->name('stuff.stuff-payment-form.update');
    Route::get('/staff/{id}/delete', [FrontController::class, 'staffPaymentFormDelete'])->name('stuff.stuff-payment-form.delete');

    Route::get('/staff/get-vendor-details/{code}', [FrontController::class, 'getVendorDetails'])->name('staff.get-vendor-details');


});
