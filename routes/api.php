<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslationController;

Route::get('/translations', [TranslationController::class, 'getTranslations']);
