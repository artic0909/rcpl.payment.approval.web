<?php

use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:staff'])->group(function () {

    Route::get('/staff/staff-payment-form', [FrontController::class, 'staffPaymentFormView'])->name('staff.staff-payment-form');
    Route::post('/staff/staff-payment-form', [FrontController::class, 'staffPaymentForm'])->name('staff.staff-payment-form.store');
    Route::get('/staff/staff-profile', [FrontController::class, 'staffProfileView'])->name('staff.staff-profile');
    Route::post('/staff/staff-logout', [FrontController::class, 'logoutStaff'])->name('staff.logout');
    Route::get('/staff/payment-pdf/{id}', [FrontController::class, 'paymentPdfDownload'])->name('staff.payment.pdf');
    Route::post('/staff/profile/update', [FrontController::class, 'profileUpdate'])->name('staff.profile.update');

});
