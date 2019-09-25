<?php

use App\User;
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



Route::get('roles-test', function () {
    $user = User::find(501);
    return $user->roles;
})->middleware(['auth', 'roleissupport']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
