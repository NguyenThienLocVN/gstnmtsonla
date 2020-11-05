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
Route::group([
    'name' => 'tai-nguyen-nuoc',
    'prefix' => 'tai-nguyen-nuoc',
], function () {
    Route::get('/', 'WaterResourceController@index')->name('tai-nguyen-nuoc');

    // Bao cao
    Route::get('/bao-cao', 'WaterResourceController@getReports')->name('tai-nguyen-nuoc.bao-cao');
});

// Khi tuong thuy van
Route::group([
    'name' => 'khi-tuong-thuy-van',
    'prefix' => 'khi-tuong-thuy-van',
], function () {
    Route::get('/', 'HydrologicalController@index')->name('khi-tuong-thuy-van');
    Route::get('quan-trac/so-lieu-khi-tuong', 'HydrologicalController@meteorologyData')->name('khi-tuong-thuy-van.so-lieu-khi-tuong');
    Route::get('quan-trac/so-lieu-khi-tuong/{id}','HydrologicalController@getMeteorologyData');
});
