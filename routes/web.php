<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ClasseController;
use App\Http\Controllers\Admin\MatiereController;
use App\Http\Controllers\Admin\EleveController;
use App\Http\Controllers\Admin\ProfesseurController;
use App\Http\Controllers\Admin\NoteController;
use App\Http\Controllers\Admin\BulletinController;
use App\Http\Controllers\CreationProfesseurController;
use App\Http\Controllers\CreationEleveController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('admin')->middleware('auth')->name('admin.')->group(function(){
    Route::resource('classe', ClasseController::class)->except(['show']);
    Route::resource('matiere', MatiereController::class)->except(['show']);
    Route::resource('professeur', ProfesseurController::class)->except(['show']);
    Route::resource('eleve', EleveController::class)->except(['show']);
    Route::resource('note', NoteController::class)->except(['show']);
    Route::resource('bulletin', BulletinController::class)->except(['show']);
    Route::get('/professeur/approve/{id}', [ProfesseurController::class, 'approve'])->name('professeur.approve');
    Route::get('/eleve/approve/{id}', [EleveController::class, 'approve'])->name('eleve.approve');
});

// Route pour la création d'un professeur
Route::get('/creation/professeur/{user}', [CreationProfesseurController::class, 'create'])->name('create.professeur');

// Route pour traiter la soumission du formulaire et créer un professeur
Route::post('/creation/professeur', [CreationProfesseurController::class, 'store'])->name('professeur.store');

// Route pour la création d'un élève
Route::get('/creation/eleve/{user}', [CreationEleveController::class, 'create'])->name('create.eleve');

// Route pour traiter la soumission du formulaire et créer un eleve
Route::post('/creation/eleve', [CreationEleveController::class, 'store'])->name('eleve.store');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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

require __DIR__.'/auth.php';

// routes/web.php


Route::get('/', function () {
    return view('welcome');
});

// Vos autres routes existantes...

