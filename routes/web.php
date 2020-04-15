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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
