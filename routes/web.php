<?php

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
    return view('index');
})->name('index');

Auth::routes();

// Logout link
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('register', '\App\Http\Controllers\Auth\RegisterController@doRegister');


// Tai nguyen nuoc
Route::get('/tai-nguyen-nuoc', 'WaterResourceController@index')->name('tai-nguyen-nuoc');

// Khi tuong thuy van
Route::group([
    'name' => 'khi-tuong-thuy-van.',
    'prefix' => 'khi-tuong-thuy-van',
], function () {
    Route::get('/', 'HydrologicalController@index')->name('khi-tuong-thuy-van');
    Route::get('quan-trac/so-lieu-khi-tuong', 'HydrologicalController@meteorologyData')->name('so-lieu-khi-tuong');
    Route::get('quan-trac/so-lieu-khi-tuong/{id}','HydrologicalController@getMeteorologyData');
});
