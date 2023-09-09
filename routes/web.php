<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TelegramController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CameraController;



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    


//Route::get('/show-photos', 'TelegramController@showPhotos');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/telegram/getupdates', [TelegramController::class, 'getUpdates']);
    Route::post('/telegram/send', [TelegramController::class, 'sendMessage']);


    Route::get('/cameras/exibir', [CameraController::class, 'show'])->name('cameras.index');
    Route::get('/cameras/cadastrar', [CameraController::class, 'index'])->name('cameras.cadastrar');   
    Route::post('/cameras/store', [CameraController::class, 'store'])->name('cameras.store');
    Route::delete('/cameras/delete/{id}', [CameraController::class, 'destroy'])->name('cameras.destroy');
   


});

require __DIR__.'/auth.php';
