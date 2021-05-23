<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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

Route::any('/', 'ModsController@index')->name('index');

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
    // return $teste;
    Storage::delete($teste);
});
/*rotas de mods*/
Route::group(['prefix'=>'mods'], function(){
    Route::get('', 'ModsController@index')->name('mods-index');
    Route::post('approved', 'ModsController@approvedMod')->name('mods-approved');
    Route::get('/detail/{id}', 'ModsController@detail')->name('mods-detail');
    Route::post('/create', 'ModsController@create')->name('mods-create');
    Route::post('/edit', 'ModsController@edit')->name('mods-edit');
    Route::post('/delete', 'ModsController@delete')->name('mods-delete');
});

Route::group(['prefix'=>'admin', 'middleware'=>'auth'], function(){
    Route::get('', 'AdminController@index')->name('admin-index');

    Route::get('/mods/approved', 'AdminController@approved')->name('mod-approved');

    Route::get('/listusers', 'AdminController@listUsers')->name('admin-listusers');
    Route::get('/create', 'AdminController@getStrutureCreate')->name('admin-create');
    Route::get('/edit/tag/{id}', 'TagsController@getStrutureTag')->name('admin-edit-tag');
    Route::get('/getcategoryandtags', 'AdminController@getCategoryAndTag')->name('admin-category-and-tag');
});

Route::group(['prefix'=>'user', 'middleware'=>'auth'], function(){
    Route::get('', 'UserController@index')->name('user-index');

    Route::post('update/image', 'UserController@updateImage')->name('user-image-update');
    
    Route::post('update/password', 'UserController@updatePassword')->name('user-password-update');

    Route::get('/create', 'UserController@getStrutureCreate')->name('user-create');
    Route::get('/edit', 'UserController@getStrutureEdit')->name('user-edit');
    Route::get('/profile', 'UserController@getStrutureEdit')->name('user-profile');
});


Route::get('/images/{path}/{args}', function($path, $args){

    $file = Storage::disk('local')->get("images/$path/$args");
    $logo = Storage::disk('local')->get("logo-img/aHt89Ld9It1YpuQjU6Amrjytsh0erl29N9EZiJAW.png");
    
    $img  = Image::make($file);
    $logo = Image::make($logo)->resize(80, null, function ($constraint) { $constraint->aspectRatio(); } );
    $img->insert($logo, 'bottom-right', 56, 1);

    return $img->response('jpg', 70);
});

Route::get('/images/user/img/perfil/{args}', function ($args)
{
    $file = Storage::disk('local')->get("user/img/perfil/$args");
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

Route::group(['prefix'=>'notification'], function(){
    Route::post('/get', 'NotificationsController@getNotification')->name('notification-get');
    // Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
    // Route::get('/delete', 'CommentController@delete')->name('comments-delete');
});

/*Rotas likes*/
Route::group(['prefix'=>'like'], function(){
    Route::post('/create', 'LikeController@create')->name('like-create');
    Route::delete('/delete', 'LikeController@delete')->name('like-delete');
 });

// /*Rotas estrelas*/
// Route::group(['prefix'=>'stars'], function(){
//     Route::get('/create', '');
//     Route::get('/delete', '');
// });



Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix'=> 'gtav'], function(){
    
});

Route::get('resize/{resize}/mods/images/{args}', function($resize,$args){
    $resize = explode('-', $resize);

    $file = Storage::disk('local')->get("/mods/images/{$args}");
    $logo = Storage::disk('local')->get("logo-img/aHt89Ld9It1YpuQjU6Amrjytsh0erl29N9EZiJAW.png");
    
    $img  = Image::make($file)->resize($resize[0], $resize[1]);
    $logo = Image::make($logo)->resize(150, null, function ($constraint) { $constraint->aspectRatio(); } );
    $img->insert($logo, 'bottom-right', 10, 10);

    return $img->response('jpg', $resize[2]);
})->name('resize-image');
