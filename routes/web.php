<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redireciona a página inicial para o login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rotas de autenticação (não precisam de middleware)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Rota de logout (pode ser acessada mesmo sem token válido)
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas - precisam do middleware de verificação de token
Route::middleware(['check.auth.token'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/notifications', [SettingsController::class, 'updateNotifications'])->name('settings.notifications');
    Route::get('/settings/extend-session', [SettingsController::class, 'extendSession'])->name('settings.extend-session');
    Route::get('/settings/revoke-tokens', [SettingsController::class, 'revokeAllTokens'])->name('settings.revoke-tokens');
    Route::get('/settings/export-data', [SettingsController::class, 'exportData'])->name('settings.export-data');
});
