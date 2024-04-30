<?php

use App\Http\Controllers\CritereController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversiteController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Universités
Route::middleware(['auth'])->group(function () {
    Route::get('/universites', [UniversiteController::class, 'index'])->name('universites.index');
    Route::get('/universite/create', [UniversiteController::class, 'create'])->name('universites.create');
    Route::post('/universite', [UniversiteController::class, 'store'])->name('universites.store');
    Route::get('/universite/{universite}', [UniversiteController::class, 'show'])->name('universites.show');
    Route::get('/universite/{universite}/edit', [UniversiteController::class, 'edit'])->name('universites.edit');
    Route::put('/universite/{universite}', [UniversiteController::class, 'update'])->name('universites.update');
    Route::delete('/universite/{universite}', [UniversiteController::class, 'destroy'])->name('universites.destroy');
});

// Critères
Route::middleware(['auth'])->group(function () {
    Route::get('/criteres', [CritereController::class, 'index'])->name('criteres.index');
    Route::get('/critere/create', [CritereController::class, 'create'])->name('criteres.create');
    Route::post('/critere', [CritereController::class, 'store'])->name('criteres.store');
    Route::get('/critere/{critere}', [CritereController::class, 'show'])->name('criteres.show');
    Route::get('/critere/{critere}/edit', [CritereController::class, 'edit'])->name('criteres.edit');
    Route::put('/critere/{critere}', [CritereController::class, 'update'])->name('criteres.update');
    Route::delete('/critere/{critere}', [CritereController::class, 'destroy'])->name('criteres.destroy');
});

// Utilisateurs
Route::middleware(['auth'])->group(function () {
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');
    Route::get('/utilisateur/create', [UserController::class, 'create'])->name('utilisateurs.create');
    Route::post('/utilisateur', [UserController::class, 'store'])->name('utilisateurs.store');
    Route::get('/utilisateur/{utilisateur}', [UserController::class, 'show'])->name('utilisateurs.show');
    Route::get('/utilisateur/{utilisateur}/edit', [UserController::class, 'edit'])->name('utilisateurs.edit');
    Route::put('/utilisateur/{utilisateur}', [UserController::class, 'update'])->name('utilisateurs.update');
    Route::delete('/utilisateur/{utilisateur}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');
});



require __DIR__ . '/auth.php';
