<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/epistolary-novels', function () {
    return view('epistolary-novels');
})->name('epistolary-novels');

Route::get('/credits', function () {
    return view('credits');
})->name('credits');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/about', function () {
    return view('about');
})->name('about');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::get(config('backpack.base.route_prefix') . '/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('backpack.logout');
    Route::get(config('backpack.base.route_prefix') . '/login', '\App\Http\Controllers\Auth\LoginController@login')->name('backpack.login');
});
