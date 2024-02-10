<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AtmNoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/initialize', [AtmNoteController::class, 'initializeAtm']);
Route::get('/available-notes', [AtmNoteController::class, 'getAvailableNotes']);
Route::post('/dispense-money', [AtmNoteController::class, 'dispenseMoney']);
