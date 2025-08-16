<?php

use App\Http\Controllers\Api\AkreditasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProgramStudiController;

Route::get('/program-studi', [ProgramStudiController::class, 'index']);
Route::get('/akreditasi', [AkreditasiController::class, 'index']);
