<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SentenceController;

Route::get('/', [SentenceController::class, 'index']);
