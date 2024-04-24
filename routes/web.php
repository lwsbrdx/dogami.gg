<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompareDogamisController;
use App\Http\Controllers\DesignSystemController;
use App\Http\Controllers\DogamisController;
use App\Http\Controllers\LeaderboardsController;
use App\Http\Controllers\SimulatorsController;
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

/*
| ADMIN 
*/

Route::controller(AdminController::class)->domain('admin.' . config('app.url'))->group(static function () {
    Route::get('/', 'index');
});

/*
| DESIGN
*/
Route::domain('design.' . config('app.url'))->get('/', [DesignSystemController::class, 'index']);

/*
| ROOT DOMAIN
*/
Route::get('/', [DogamisController::class, 'all'])->name('home');
Route::get('/dogami/{dogami_id}', [DogamisController::class, 'one'])->name('dogamis.one');
Route::post('/dogami/{dogami_id}', [DogamisController::class, 'update'])->name('dogamis.one.update');
Route::post('/dogamis/{ids}', [DogamisController::class, 'updateMany'])->name('dogamis.many.update');

Route::get('/leaderboards', [LeaderboardsController::class, 'all'])->name('leaderboards');
Route::get('/leaderboards/levels', [LeaderboardsController::class, 'orderByLevel'])->name('leaderboard.levels');
Route::get('/leaderboards/{skill_type}', [LeaderboardsController::class, 'show'])->name('leaderboard');

Route::get('/compare/{dogamis_list?}', [CompareDogamisController::class, 'show'])->name('compare');

Route::match(
    ['get', 'post'],
    '/simulators/skills-trainings',
    [SimulatorsController::class, 'trainings']
)->name('simulators.training.skills');

Route::match(
    ['get', 'post'],
    '/simulators/dogami-training',
    [SimulatorsController::class, 'trainOneDogami']
)->name('simulators.training.dogami');
