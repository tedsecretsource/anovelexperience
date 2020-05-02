<?php

use App\Http\Controllers\SubscriptionController;
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

Route::get('/credits', function () {
    return view('credits');
})->name('credits');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/epistolary-novels', 'NovelController@index')->name('novels');
Route::get('/epistolary-novels/{id}', 'NovelController@show')->name('novel.detail');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/settings', 'SettingsController@main')->name('settings');
    Route::get('/epistolary-novels/{id}/subscribe', 'SubscriptionController@create')->name('novel.subscribe');
    Route::post('/epistolary-novels/{id}/subscribe', 'SubscriptionController@store')->name('novel.subscribe');
    Route::get('/epistolary-novels/{id}/settings', 'NovelController@settings')->name('novel.settings');
    Route::post('/epistolary-novels/{id}/settings', 'NovelController@updateSettings')->name('novel.settings');

    Route::get(config('backpack.base.route_prefix') . '/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('backpack.logout');
    Route::get(config('backpack.base.route_prefix') . '/login', '\App\Http\Controllers\Auth\LoginController@login')->name('backpack.login');
    Route::get('gift-subscription-email', function () {
        $to_user = App\User::where('email', 'lucas@stresen-reuter.com')->first();
        $giver_user = App\User::find(1);
        $novel = App\Novel::find(1);

        return new App\Mail\GiftSubscriptionInvite($to_user, $giver_user, $novel);
    });
    Route::get('novel-entry', function () {
        $user = App\User::find(5);
        $entry = App\Entry::find(1);

        return new App\Mail\StandardEntry($user, $entry);
    });
});
