<?php

use App\Category;
use App\Product;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Get Categories
Route::get('categories', 'Api\CategoryController@index');
Route::get('categories/{id}', 'Api\CategoryController@show');
Route::get('categories/{id}/products', 'Api\CategoryController@products');

//Get Tags
Route::get('tags', 'Api\TagController@index');

//Get Units
Route::get('units', 'Api\UnitController@index');

//Get Products
Route::get('products', 'Api\ProductController@index');
Route::get('products/{id}', 'Api\ProductController@show');

//General Route

Route::get('countries', 'Api\CountryController@index');
Route::get('countries/{id}/states', 'Api\CountryController@showStates');
Route::get('countries/{id}/cities', 'Api\CountryController@showCities');


Route::post('auth/register', 'Api\AuthController@register');
Route::post('auth/login', 'Api\AuthController@login');

Route::group(['auth:api'], function () { });
