<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SchemaController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes (Harus Login)
Route::middleware('auth')->group(function () {
    // Dashboard umum (bisa mengarahkan ke tampilan beda berdasarkan role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route khusus User biasa untuk edit profil diri sendiri
    Route::get('/profile/edit', [ParticipantController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [ParticipantController::class, 'updateProfile'])->name('profile.update');

    // Route khusus ADMIN (Skema & Manajemen Peserta Penuh)
    Route::middleware(['admin'])->group(function () {
        Route::resource('schemas', SchemaController::class);
        Route::resource('participants', ParticipantController::class);
    });
});