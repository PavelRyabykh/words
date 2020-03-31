<?php

use App\Category;
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
Route::middleware('auth')->group(function () {
    Route::get('/', 'CategoriesController@main');
});

Route::resource('/categories', 'CategoriesController')->middleware('auth');
Route::resource('/words', 'WordsController')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
