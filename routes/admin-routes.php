<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [AdminController::class, 'adminLoginView'])->name('admin.login');
// Route::get('/admin/register', [AdminController::class, 'adminRegisterView'])->name('admin.register');
// Route::post('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register.store');
Route::post('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login.verify');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboardView'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/payment-pdf/{id}', [AdminController::class, 'paymentPdfDownload'])->name('admin.payment.pdf');
    Route::get('/admin/payment-pdf-view/{id}', [AdminController::class, 'adminPdfView'])->name('admin.payment.pdf.view');
    Route::get('/admin/export/payment-requests', [AdminController::class, 'exportInExcel'])->name('export.payment.requests');

    Route::post('/admin/add-remarks/{id}', [AdminController::class, 'addRemarks'])->name('admin.add.remarks');
    Route::post('/admin/approved/{id}', [AdminController::class, 'approvedStatus'])->name('admin.approved.status');
    Route::post('/admin/rejected/{id}', [AdminController::class, 'rejectedStatus'])->name('admin.rejected.status');
    Route::post('/admin/payment-status/{id}', [AdminController::class, 'paymentStatus'])->name('admin.payment.status');
    Route::post('/admin/edit-amount/{id}', [AdminController::class, 'editAmount'])->name('admin.edit.amount');



    Route::get('/admin/pending-requests', [AdminController::class, 'adminPendingRequestsView'])->name('admin.pending-requests');

    Route::get('/admin/approved-requests', [AdminController::class, 'adminApprovedRequestsView'])->name('admin.approved-requests');
    Route::get('/admin/rejected-requests', [AdminController::class, 'adminRejectedRequestsView'])->name('admin.rejected-requests');
    Route::get('/admin/all-requests', [AdminController::class, 'adminAllRequestsView'])->name('admin.all-requests');
    Route::get('/admin/payments-done', [AdminController::class, 'adminPaymentsDoneView'])->name('admin.done-requests');
    Route::get('/admin/profile', [AdminController::class, 'adminProfileView'])->name('admin.profile');
    Route::post('/admin/profile', [AdminController::class, 'adminUpdateProfile'])->name('admin.profile.update');

    


});
