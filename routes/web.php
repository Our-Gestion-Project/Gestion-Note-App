<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaisirController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    route::get('/saisir-note-sesstion-normale',[SaisirController::class,'saisir_normale'])->name('normale');
    route::get('/saisir-note-sesstion-rattrapage',[SaisirController::class,'saisir_rattrapage'])->name('rattrapage');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

# For test
# Email admin.admin@gmail.com
# Password admin1234