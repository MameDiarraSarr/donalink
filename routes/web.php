<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\DistributionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

// Campagnes
Route::resource('campagnes', CampagneController::class)
    ->middleware(['auth', 'admin'])
    ->names('campagnes');

// Dons
Route::resource('dons', DonController::class)
    ->middleware(['auth'])
    ->names('dons');

// Bénéficiaires
Route::resource('beneficiaires', BeneficiaireController::class)
    ->middleware(['auth', 'admin'])
    ->names('beneficiaires');

// Distributions
Route::resource('distributions', DistributionController::class)
    ->middleware(['auth', 'admin'])
    ->names('distributions');

// Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/mes-dons', [DonController::class, 'mesDons'])
    ->middleware(['auth'])
    ->name('dons.mes-dons');

require __DIR__.'/auth.php';