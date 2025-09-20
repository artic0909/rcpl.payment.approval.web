<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;


Route::get('/account/login', [AccountController::class, 'accountLoginView'])->name('account.login');
// Route::get('/account/register', [AccountController::class, 'accountRegisterView'])->name('account.register');
// Route::post('/account/register', [AccountController::class, 'accountRegister'])->name('account.register.store');
Route::post('/account/login', [AccountController::class, 'accountLogin'])->name('account.login.verify');


Route::middleware(['auth:account'])->group(function () {
    Route::get('/account/dashboard', [AccountController::class, 'accountDashboardView'])->name('account.dashboard');
    Route::get('/account/logout', [AccountController::class, 'accountLogout'])->name('account.logout');

    Route::get('/account/pending-requests', [AccountController::class, 'accountPendingRequestsView'])->name('account.pending-requests');
    Route::post('/account/pending-requests/{id}', [AccountController::class, 'paymentStatus'])->name('account.payment.status');

    Route::get('/account/approved-requests', [AccountController::class, 'accountApprovedRequestsView'])->name('account.approved-requests');
    Route::get('/account/rejected-requests', [AccountController::class, 'accountRejectedRequestsView'])->name('account.rejected-requests');
    Route::get('/account/all-requests', [AccountController::class, 'accountAllRequestsView'])->name('account.all-requests');
    Route::get('/account/profile', [AccountController::class, 'accountProfileView'])->name('account.profile');
    Route::post('/account/profile', [AccountController::class, 'accountUpdateProfile'])->name('account.profile.update');

    Route::get('/account/payment-pdf-view/{id}', [AccountController::class, 'acoountPdfView'])->name('account.payment.pdf.view');


    // My Request
    Route::get('/account/my-request', [AccountController::class, 'accountMyRequestView'])->name('account.my-request');
    Route::post('/account/my-request', [AccountController::class, 'accountMyRequestStore'])->name('account.my-request.store');
    Route::put('/account/my-request/payment/{id}', [AccountController::class, 'accountMyRequestUpdate'])->name('account.my-request.update');
    Route::delete('/account/my-request/{id}', [AccountController::class, 'accountMyRequestDelete'])->name('account.my-request.delete');
    Route::put('/account/my-request/{id}', [AccountController::class, 'accountMyRequestPaymentStatusUpdate'])->name('account.my-request.status');

    Route::get('/account/my-request/pdf/{id}', [AccountController::class, 'showMyRequestPdf'])->name('account.my-request.pdf');
});
