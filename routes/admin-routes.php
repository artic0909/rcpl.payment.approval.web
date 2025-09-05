<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/login', [AdminController::class, 'adminLoginView'])->name('admin.login');
Route::get('/admin/register', [AdminController::class, 'adminRegisterView'])->name('admin.register');
Route::post('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register.store');
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


});
