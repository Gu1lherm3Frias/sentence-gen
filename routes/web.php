<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentenceController;

Route::get('/', [SentenceController::class, 'index'])->name('sentences.index');
Route::resource('sentences', SentenceController::class)->except(['index']);
Route::get('/sentenceOfTheDay', [SentenceController::class, 'randomSentenceOfTheDay']);