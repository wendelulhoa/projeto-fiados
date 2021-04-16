<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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



// Route::post('user/create', 'UserController@create')->name('create-user');

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/*rotas de tags*/

Route::group(['prefix'=>'tag'], function(){
    Route::get('', 'TagsController@index')->name('tags-index');
    Route::post('/create', 'TagsController@create')->name('tags-create');
    Route::post('/edit', 'TagsController@edit')->name('tags-edit');
    Route::post('/delete', 'TagsController@delete')->name('tags-delete');
});

/*rotas categorias*/
Route::group(['prefix'=>'category'], function(){
    Route::get('', 'CategoryController@index')->name('category-index');
    Route::post('/create', 'CategoryController@create')->name('category-create');
    Route::post('/edit', 'CategoryController@edit')->name('category-edit');
    Route::post('/delete', 'CategoryController@delete')->name('category-delete');
});

/*rotas de mods*/
Route::group(['prefix'=>'mods'], function(){
    Route::get('', 'ModsController@index')->name('mods-index');
    Route::post('/create', 'ModsController@create')->name('mods-create');
    Route::post('/edit', 'ModsController@edit')->name('mods-edit');
    Route::post('/delete', 'ModsController@delete')->name('mods-delete');
});