<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'tag'], function(){
    Route::get('', 'TagsController@index')->name('tags-index');
    Route::post('/create', 'TagsController@create')->name('tags-create');
    Route::post('/edit', 'TagsController@edit')->name('tags-edit');
    Route::post('/delete', 'TagsController@delete')->name('tags-delete');
});

Route::group(['prefix'=>'category'], function(){
    Route::get('', 'CategoryController@index')->name('category-index');
    Route::post('/create', 'CategoryController@create')->name('category-create');
    Route::post('/edit', 'CategoryController@edit')->name('category-edit');
    Route::post('/delete', 'CategoryController@delete')->name('category-delete');
});

Route::group(['prefix'=>'mods'], function(){
    Route::get('', 'ModsController@index')->name('mods-index');
    Route::post('/create', 'ModsController@create')->name('mods-create');
    Route::post('/edit', 'ModsController@edit')->name('mods-edit');
    Route::post('/delete', 'ModsController@delete')->name('mods-delete');
});