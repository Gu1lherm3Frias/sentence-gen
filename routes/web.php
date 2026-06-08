<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\AuthController;
use App\Models\User;

Route::get('/', [SentenceController::class, 'index'])->name('sentences.index');
Route::get('/sentenceOfTheDay', [SentenceController::class, 'randomSentenceOfTheDay'])->name('sentences.randomSentenceOfTheDay');
Route::get('/callback', [AuthController::class, 'callback']);

// Rotas protegidas (com auth) - Usando grupo com middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('/sentences/create', [SentenceController::class, 'create'])->name('sentences.create');
    Route::post('/sentences', [SentenceController::class, 'store'])->name('sentences.store');
    Route::get('/sentences/{sentence}/edit', [SentenceController::class, 'edit'])->name('sentences.edit');
    Route::put('/sentences/{sentence}', [SentenceController::class, 'update'])->name('sentences.update');
    Route::delete('/sentences/{sentence}', [SentenceController::class, 'destroy'])->name('sentences.destroy');
});

Route::get('/sentences/{sentence}', [SentenceController::class, 'show'])->name('sentences.show');