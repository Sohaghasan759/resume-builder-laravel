<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TexController;





Route::get('/', [TexController::class, 'index']);
Route::post('/convert', [TexController::class, 'convert'])->name('convert');