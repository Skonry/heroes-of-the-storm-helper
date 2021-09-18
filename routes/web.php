<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::get('/', function () {
    return Inertia::render('Home');
});
Route::resource('heroes', 'App\Http\Controllers\HeroController');
Route::resource('builds', 'App\Http\Controllers\BuildController');
Route::resource('heroes.builds', 'App\Http\Controllers\HeroBuildController');
Route::post('builds/{build}/upvotes', 'App\Http\Controllers\BuildUpvoteController@store');
Route::resource('tier_lists', 'App\Http\Controllers\TierListController');
