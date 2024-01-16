<?php

use App\Http\Controllers\CompareDogamisController;
use App\Http\Controllers\DogamisController;
use App\Http\Controllers\LeaderboardsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DogamisController::class, 'all'])->name('home');
Route::get('/dogami/{dogami_id}', [DogamisController::class, 'one'])->name('dogamis.one');
Route::post('/dogami/{dogami_id}', [DogamisController::class, 'update'])->name('dogamis.one.update');
Route::post('/dogamis/{ids}', [DogamisController::class, 'updateMany'])->name('dogamis.many.update');

Route::get('/leaderboards', [LeaderboardsController::class, 'all'])->name('leaderboards');
Route::get('/leaderboards/{skill_type}', [LeaderboardsController::class, 'show'])->name('leaderboard');

Route::get('/compare/{dogamis_list}', [CompareDogamisController::class, 'show'])->name('compare');
