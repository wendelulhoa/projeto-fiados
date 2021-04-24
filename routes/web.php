<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ModsController@index')->name('index');

/*rotas de tags*/

Route::group(['prefix'=>'tags'], function(){
    /*carrega estrutura*/
    Route::get('', 'TagsController@index')->name('tags-struture-index');
    Route::post('/create', 'TagsController@create')->name('tags-struture-create');
    Route::post('/edit', 'TagsController@edit')->name('tags-struture-edit');

    /*rotas de controle*/
    Route::post('/create', 'TagsController@create')->name('tags-create');
    Route::post('/edit/{id}', 'TagsController@edit')->name('tags-edit');
    Route::delete('/delete/{id}', 'TagsController@delete')->name('tags-delete');
});

/*rotas categorias*/
Route::group(['prefix'=>'category/mods'], function(){
    /*carrega estrutura*/
    Route::get('', 'CategoryModsController@index')->name('category-index');
    Route::post('/create', 'CategoryModsController@create')->name('category-struture-create');
    Route::post('/edit', 'CategoryModsController@edit')->name('category-struture-edit');
    
    /**/
    Route::post('/create', 'CategoryModsController@create')->name('category-create');
    Route::post('/edit', 'CategoryModsController@edit')->name('category-edit');
    Route::post('/delete', 'CategoryModsController@delete')->name('category-delete');
});

route::get('teste', function(){
    
    $teste = Storage::allFiles('mods/images');
    Storage::delete($teste);
});
/*rotas de mods*/
Route::group(['prefix'=>'mods'], function(){
    Route::get('', 'ModsController@index')->name('mods-index');

    Route::get('/detail/{id}', 'ModsController@detail')->name('mods-detail');
    Route::post('/create', 'ModsController@create')->name('mods-create');
    Route::post('/edit', 'ModsController@edit')->name('mods-edit');
    Route::post('/delete', 'ModsController@delete')->name('mods-delete');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
    Route::get('', 'AdminController@index')->name('admin-index');

    Route::get('/listusers', 'AdminController@listUsers')->name('admin-listusers');
    Route::get('/create', 'AdminController@getStrutureCreate')->name('admin-create');
    Route::get('/edit/tag/{id}', 'TagsController@getStrutureTag')->name('admin-edit-tag');
    Route::get('/getcategoryandtags', 'AdminController@getCategoryAndTag')->name('admin-category-and-tag');
});

Route::group(['prefix'=>'user', 'middleware'=>'auth'], function(){
    Route::get('', 'UserController@index')->name('user-index');

    Route::get('/create', 'UserController@getStrutureCreate')->name('User-create');
});

// rota que acessa as fotos salvas
Route::get('mods/images/{args}', function ($args)
{
    $file = Storage::disk('local')->get("mods/images/$args");
    if(strpos($args, 'pdf')){
        return response()->make($file,200,[ 'Content-Type' => 'application/pdf']);
    }else if(strpos($args, 'jpeg')){
        return response()->make($file,200,[ 'Content-Type' => 'image/jpeg']);
    }else {
        return response()->make($file,200,[ 'Content-Type' => 'image/png']);
    }
    
});

/*Rotas comentarios*/
Route::group(['prefix'=>'comments'], function(){
    Route::post('/create', 'CommentController@create')->name('comments-create');
    Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
    Route::get('/delete', 'CommentController@delete')->name('comments-delete');
});

// /*Rotas likes*/
// Route::group(['prefix'=>'likes'], function(){
//     Route::get('/create', '');
//     Route::get('/delete', '');
//  });

// /*Rotas estrelas*/
// Route::group(['prefix'=>'stars'], function(){
//     Route::get('/create', '');
//     Route::get('/delete', '');
// });

Route::get('logout', 'Auth\LoginController@logout')->name('logout');