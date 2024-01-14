<?php

use App\Http\Controllers\DogamisController;
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
