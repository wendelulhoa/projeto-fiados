<?php

use App\Http\Controllers\AuthController;
use GuzzleHttp\Psr7\Request;
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
    $test2 = Storage::allFiles('images/mods-principal');
    
    Storage::delete($teste);
    Storage::delete($test2);
});


/*rotas de mods*/
Route::group(['prefix'=>'mods'], function(){
    Route::get('', 'ModsController@index')->name('mods-index');

    Route::post('approved', 'ModsController@approvedMod')->name('mods-approved');
    Route::get('/detail/{id}', 'ModsController@detail')->name('mods-detail');
    
    Route::post('/store/images', 'ModsController@imageStorage')->middleware('auth')->name('mods-store-images');

    Route::post('/create', 'ModsController@create')->middleware('auth')->name('mods-create');
    Route::get('/edit/{id}', 'ModsController@getStrutureEdit')->middleware('auth')->name('mods-edit');
    Route::post('/update/{id}', 'ModsController@getStrutureEdit')->middleware('auth')->name('mods-update');
    Route::get('/delete/{id}', 'ModsController@delete')->middleware('auth')->name('mods-delete');
    Route::delete('/delete/images/{id}', 'ModsController@deleteImage')->middleware('auth')->name('mods-images-delete');
});

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'verified']], function(){
    Route::get('', 'AdminController@index')->name('admin-index');

    Route::get('/mods/approved', 'AdminController@approved')->name('mod-approved');
    Route::get('/mods/not/approved', 'AdminController@notApproved')->name('mod-not-approved');

    Route::post('/user/disable/{id}', 'UserController@disableUser')->name('admin-user-disable');
    Route::post('/user/active/{id}', 'UserController@activeUser')->name('admin-user-active');

    Route::get('/listusers', 'UserController@getStrutureUsers')->name('admin-listusers');
    Route::get('/create', 'AdminController@getStrutureCreate')->name('admin-create');

    Route::get('/edit/tag/{id}', 'TagsController@getStrutureTag')->name('admin-edit-tag');
    Route::get('/getcategoryandtags', 'AdminController@getCategoryAndTag')->name('admin-category-and-tag');
});

Route::group(['prefix'=>'user', 'middleware'=>['auth', 'verified']], function(){
    Route::get('', 'UserController@index')->name('user-index');

    Route::post('update/image', 'UserController@updateImage')->name('user-image-update');
    
    Route::post('update/password', 'UserController@updatePassword')->name('user-password-update');

    Route::get('/create', 'UserController@getStrutureCreate')->name('user-create');
    Route::get('/edit', 'UserController@getStrutureEdit')->name('user-edit');
    Route::get('/profile', 'UserController@getStrutureEdit')->name('user-profile');
});


Route::get('/images/{path}/{args}', function($path, $args){
    
    $img = Image::cache(function($image) use($args, $path){
            $file = Storage::disk('local')->get("images/$path/$args");
            $img = $image->make($file);
        },24000, true );

    return Image::make($img)->response('jpg', 80);
});

Route::get('/get/logo', function(){

    $logo = Storage::disk('local')->get("logo-img/logo.png");

    $logo = Image::make($logo)->resize(256, null, function ($constraint) { $constraint->aspectRatio(); } );

    return $logo->response('png', 70);
})->name('get-logo');

Route::get('/images/user/img/perfil/{args}', function ($args)
{
    $img = Image::cache(function($image) use($args){
            $file = Storage::disk('local')->get("user/img/perfil/$args");
            $img = $image->make($file)->resize(256, null, function ($constraint) { $constraint->aspectRatio(); } );
        },24000, true );

    return Image::make($img)->response('jpg', 60);
});

/*Rotas comentarios*/
Route::group(['prefix'=>'comments'], function(){
    Route::post('/create', 'CommentController@create')->name('comments-create');
    Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
    Route::get('/delete', 'CommentController@delete')->name('comments-delete');
});

Route::group(['prefix'=>'notification'], function(){
    Route::post('/get', 'NotificationsController@getNotification')->name('notification-get');
    Route::get('', 'NotificationsController@index')->name('notification-index');
    Route::post('/disable', 'NotificationsController@disable')->name('notification-disable');
    // Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
    // Route::get('/delete', 'CommentController@delete')->name('comments-delete');
});

/*Rotas likes*/
Route::group(['prefix'=>'like'], function(){
    Route::post('/create', 'LikeController@create')->name('like-create');
    Route::delete('/delete', 'LikeController@delete')->name('like-delete');
 });

/*Rotas estrelas*/
Route::group(['prefix'=>'stars'], function(){
    Route::post('/create', 'StarController@create')->name('star-create');
    Route::delete('/delete', 'StarController@delete')->name('star-delete');
});



Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix'=> 'gtav'], function(){
    
});

Route::group(['prefix'=> 'gtaiv'], function(){
    
});

Route::group(['prefix'=> 'gtasa'], function(){
    
});

Route::group(['prefix'=> 'ets2'], function(){
    
});

Route::group(['prefix'=> 'assetocorsa'], function(){
    
});

Route::group(['prefix'=> 'models3d'], function(){
    
});

Route::get('resize/{resize}/mods/images/{args}', function($resize,$args){
    $resize = explode('-', $resize);

    $img = Image::cache(function($image) use($args, $resize){
            $file = Storage::disk('local')->get("/mods/images/{$args}");
            $img = $image->make($file)->resize($resize[0], $resize[1]);
        },24000, true );

    return Image::make($img)->response('jpg', $resize[2]);
})->name('resize-image');

Route::any('watermark', 'AdminController@waterMark')->name('water-mark');
Auth::routes(['verify' => true]);
