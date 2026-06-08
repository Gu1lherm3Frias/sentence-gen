<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentenceController;
use App\Http\Controllers\AuthController;
use App\Models\User;

Route::get('/', [SentenceController::class, 'index'])->name('sentences.index');
Route::resource('sentences', SentenceController::class)->except(['index']);
Route::get('/sentenceOfTheDay', [SentenceController::class, 'randomSentenceOfTheDay']);
Route::get('/callback', [AuthController::class, 'callback']);
