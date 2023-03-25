<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaisirController;
use App\Http\Controllers\SecretCodeController;
use Illuminate\Support\Facades\Route;

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
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('verifier_code_secret/{ids}',[SecretCodeController::class,'verifier_information'])->name('verifier');
    Route::get('Saisir_code_secret/{ids}', [SecretCodeController::class,'saisir_code_secret'])->name('codeS');
    Route::get('/saisir-note', [SaisirController::class,'saisir_note'])->name('saisir');

});

require __DIR__.'/auth.php';
    