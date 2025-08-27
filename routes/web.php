<?php

use App\Http\Controllers\FrontController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'LoginView'])->name('home');
Route::post('/staff-login', [FrontController::class, 'staffLogin'])->name('staff.login');
Route::get('/staff-register', [FrontController::class, 'signupView'])->name('staff-register');
Route::post('/staff-register', [FrontController::class, 'staffRegister'])->name('staff.register');
Route::get('/staff-forget-password', [FrontController::class, 'forgetPasswordView'])->name('staff.forget-password');




Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
