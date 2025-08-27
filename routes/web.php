<?php

use App\Http\Controllers\FrontController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'LoginView'])->name('home');
Route::post('/stuff-login', [FrontController::class, 'staffLogin'])->name('stuff.login');
Route::get('/stuff-register', [FrontController::class, 'signupView'])->name('stuff-register');
Route::post('/staff-register', [FrontController::class, 'staffRegister'])->name('staff.register');
Route::get('/stuff-forget-password', [FrontController::class, 'forgetPasswordView'])->name('stuff-forget-password');


Route::get('/stuff/stuff-profile', [FrontController::class, 'stuffProfileView'])->name('stuff.stuff-profile');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');


    Route::get('/stuff/stuff-payment-form', [FrontController::class, 'stuffPaymentFormView'])->name('stuff.stuff-payment-form');
});

require __DIR__.'/auth.php';
