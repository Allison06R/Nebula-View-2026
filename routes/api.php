<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TranslateController;

Route::post('/translate', [TranslateController::class, 'translate'])
    ->middleware('throttle:30,1');