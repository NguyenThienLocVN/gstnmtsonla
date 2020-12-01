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

// login
Route::get('login', '\App\Http\Controllers\Auth\LoginController@showLogin')->name('login');
// Logout link
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('register', '\App\Http\Controllers\Auth\RegisterController@showRegister')->name('register');
Route::post('register', '\App\Http\Controllers\Auth\RegisterController@doRegister');


// Tai nguyen nuoc
Route::group([
    'name' => 'tai-nguyen-nuoc',
    'prefix' => 'tai-nguyen-nuoc',
], function () {
    Route::get('/', 'WaterResourceController@index')->name('tai-nguyen-nuoc');

    // Giam sat - Ho chua 
    Route::get('/giam-sat/ho-thuy-dien-tren-2mw', 'WaterResourceController@hydropowerReservoirGreaterThan2MW')->name('ho-thuy-dien-tren-2mw');
    Route::get('/district/{districtId}', 'WaterResourceController@getDataByDistrict');
    Route::get('/subregion/{subregionId}', 'WaterResourceController@getConstructionsBySubregion');

    // Bao cao
    Route::get('/bao-cao', 'WaterResourceController@getReports')->name('tai-nguyen-nuoc.bao-cao');

    // Quan ly nguoi dung
    Route::get('nguoi-dung/quan-ly-nguoi-dung', 'UsersController@userManager')->name('quan-ly-nguoi-dung');
    Route::get('nguoi-dung/thong-tin-nguoi-dung', 'UsersController@infoUser')->name('thong-tin-nguoi-dung');
    Route::get('nguoi-dung/password', 'UsersController@showUpdatePassword')->name('sua-mat-khau');
    Route::post('nguoi-dung/password', 'UsersController@updatePassword')->name('sua-mat-khau');

    // Quan ly cap phep
    Route::get('cap-phep/nuoc-mat', 'LicensesController@surfaceWater')->name('cap-phep-nuoc-mat');
    Route::get('cap-phep/{licenseId}', 'LicensesController@getLicense');

    // User active
    Route::post('nguoi-dung/kich-hoat/{id}', 'UsersController@activeUser')->name('kich-hoat-nguoi-dung');
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

// Admin
Route::group(['prefix' => 'admin'], function () {

//    Route::get('/', 'Admin\DashboardController@index')->name('admin');
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin');

    Route::group(['prefix' => 'cities'], function () {

        Route::get('index', 'Admin\CitiesController@getIndex')->name('cities.index');

        Route::get('create', 'Admin\CitiesController@getCreate')->name('cities.create');
        Route::post('create', 'Admin\CitiesController@postCreate')->name('cities.create');

        Route::post('import_cities', 'Admin\CitiesController@import')->name('cities.import');

        Route::get('edit', 'Admin\CitiesController@getEdit')->name('cities.edit');
        Route::post('edit', 'Admin\CitiesController@postEdit')->name('cities.edit');

        Route::get('delete', 'Admin\CitiesController@getDelete')->name('cities.delete');
    });

});