<?php

use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\CritereController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversiteController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/', [HomeController::class, 'index'])->name('accueil');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Universités
Route::get('/universites', [UniversiteController::class, 'index'])->name('universites.index');
Route::get('/universite/{universite}', [UniversiteController::class, 'show'])->name('universites.show');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/universite/create', [UniversiteController::class, 'create'])->name('universites.create');
    Route::post('/universite', [UniversiteController::class, 'store'])->name('universites.store');
    Route::get('/universite/{universite}/edit', [UniversiteController::class, 'edit'])->name('universites.edit');
    Route::put('/universite/{universite}', [UniversiteController::class, 'update'])->name('universites.update');
    Route::delete('/universitedes/{universite}', [UniversiteController::class, 'destroy'])->name('universites.destroy');
});
//Commentaires
Route::middleware(['auth'])->group(function () {
    Route::post('/commentaire/{universite_id}', [CommentaireController::class, 'store'])->name('commentaires.store');
    Route::delete('/commentaire/{commentaire}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');
});
// Critères
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/criteres', [CritereController::class, 'index'])->name('criteres.index');
    Route::get('/critere/create', [CritereController::class, 'create'])->name('criteres.create');
    Route::post('/critere', [CritereController::class, 'store'])->name('criteres.store');
    Route::get('/critere/{critere}', [CritereController::class, 'show'])->name('criteres.show');
    Route::get('/critere/{critere}/edit', [CritereController::class, 'edit'])->name('criteres.edit');
    Route::put('/critere/{critere}', [CritereController::class, 'update'])->name('criteres.update');
    Route::delete('/critere/{critere}', [CritereController::class, 'destroy'])->name('criteres.destroy');
});

// Utilisateurs
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/utilisateurs', [UserController::class, 'index'])->name('utilisateurs.index');
    Route::get('/utilisateur/create', [UserController::class, 'create'])->name('utilisateurs.create');
    Route::post('/utilisateur', [UserController::class, 'store'])->name('utilisateurs.store');
    Route::get('/utilisateur/{utilisateur}', [UserController::class, 'show'])->name('utilisateurs.show');
    Route::get('/utilisateur/{utilisateur}/edit', [UserController::class, 'edit'])->name('utilisateurs.edit');
    Route::get('/utilisateur/{utilisateur}/desactiver', [UserController::class, 'desactiver'])->name('utilisateurs.desactiver');
    Route::get('/utilisateur/{utilisateur}/activer', [UserController::class, 'activer'])->name('utilisateurs.activer');
    Route::delete('/utilisateur/{utilisateur}', [UserController::class, 'destroy'])->name('utilisateurs.destroy');
});
//Notation
Route::middleware(['auth'])->group(function () {
    Route::get('/notations/get/{universiteId}', [NotationController::class, 'getNotesByUniversityAndUser']);
    Route::put('/notations/update/{universiteId}', [NotationController::class, 'update'])->name('notations.update');
});


require __DIR__ . '/auth.php';
