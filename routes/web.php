<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\SchemaController;
use App\Models\Participant;
use App\Models\Schema;
use Illuminate\Support\Facades\Auth;

// Halaman Welcome
Route::get('/', function () {
    $participants = Participant::with('schema')
        ->latest()
        ->paginate(10, ['*'], 'participants_page');

    $schemas = Schema::latest()
        ->paginate(10, ['*'], 'schemas_page');

    return view('welcome', compact('participants', 'schemas'));
})->name('welcome');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Route khusus Admin
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('schemas', SchemaController::class);
        Route::resource('participants', ParticipantController::class);
    });

// Route khusus User
Route::middleware('auth')->group(function () {
    Route::get('/user/peserta', [ParticipantController::class, 'index'])
        ->name('user.participants.index');

    Route::get('/user/skema', [SchemaController::class, 'index'])
        ->name('user.schemas.index');
});

// Pengalihan dashboard berdasarkan role
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.participants.index');
    }

    return redirect()->route('user.participants.index');
})->middleware('auth')->name('dashboard');