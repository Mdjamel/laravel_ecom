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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show', 'ProductController@show');

Route::get('units', 'UnitsController@index');




Route::group(['auth', 'user_is_admin'], function () {
    //Units 
    Route::get('units', 'UnitController@index')->name('units');
    Route::post('units', 'UnitController@store');
    Route::delete('units', 'UnitController@delete');
    Route::put('units', 'UnitController@update');
    Route::post('search-unit', 'unitController@search')->name('search_unit');


    Route::get('add_unit', 'UnitController@showAdd')->name('new-unit');

    //categories

    Route::get('categories', 'CategoryController@index')->name('categories');

    //Products
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('new-product', 'ProductController@newProduct')->name('new-product');
    Route::get('update-product/{id}', 'ProductController@newProduct')->name('update-product-form');


    Route::put('update-product', 'ProductController@update')->name('update-product');
    Route::post('new-product', 'ProductController@store');
    Route::delete('new-product/{id}', 'ProductController@delete');

    //Tags

    Route::get('tags', 'TagController@index')->name('tags');

    //Payments

    //Orders

    //Shipement

    //Countrires

    Route::get('countries', 'CountryController@index')->name('countries');

    //Cities
    Route::get('cities', 'CityController@index')->name('cities');

    //State

    Route::get('states', 'StateController@index')->name('states');

    //Reviews 

    Route::get('reviews', 'ReviewController@index')->name('reviews');

    //Tickets

    Route::get('tickets', 'TicketController@index')->name('tickets');

    //Roles

    Route::get('roles', 'RoleController@index')->name('roles');
});
