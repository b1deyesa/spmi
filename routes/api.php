<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProgramStudiController;

Route::get('/program-studi', [ProgramStudiController::class, 'index']);
