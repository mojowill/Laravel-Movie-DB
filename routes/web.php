<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowsController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\PeopleController;

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::get('/movie/{movie}', [MoviesController::class, 'show'])->name('movies.show');

Route::get('/shows', [ShowsController::class, 'index'])->name('shows.index');
Route::get('/shows/{show}', [ShowsController::class, 'show'])->name('shows.show');

Route::get('/people', [PeopleController::class, 'index'])->name('people.index');
Route::get('/people/page/{page?}', [PeopleController::class, 'index']);
Route::get('/people/{person}', [PeopleController::class, 'show'])->name('people.show');
