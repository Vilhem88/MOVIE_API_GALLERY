<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TvController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MovieController::class,'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class,'show'])->name('movies.show');

Route::get('/shows', [TvController::class,'index'])->name('tvShows.index');
Route::get('/tv/shows/{show}', [TvController::class,'show'])->name('tvShows.show');


Route::get('/actors', [ActorsController::class,'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorsController::class,'index']);
Route::get('/actors/{actor}', [ActorsController::class,'show'])->name('actors.show');
