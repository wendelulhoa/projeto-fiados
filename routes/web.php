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

Auth::routes();

Route::get('', 'HomeController@index')->middleware('verify_host')->name('index');

route::get('deleteallphotos', function(){
    
    $teste = Storage::allFiles('mods/images');
    $teste1 = Storage::allFiles('user/img/perfil');
    $teste2 = Storage::allFiles('images/mods-principal');
    
    Storage::delete($teste);
    Storage::delete($teste1);
    Storage::delete($teste2);
});


Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'verify_host']], function(){
    Route::get('', 'AdminController@index')->name('admin-index');

    Route::post('/user/disable/{id}', 'UserController@disableUser')->name('admin-user-disable');
    Route::post('/user/active/{id}', 'UserController@activeUser')->name('admin-user-active');

    Route::get('/listusers', 'UserController@getStrutureUsers')->name('admin-listusers');

    Route::group(['prefix'=>'create'], function(){
        Route::get('/client', 'UserController@getStrutureEdit')->name('create-client');
        Route::get('/purchases', 'UserController@getStrutureEdit')->name('create-purchases');
    });
});

Route::group(['prefix'=>'user', 'middleware'=>['auth', 'verify_host']], function(){
    Route::get('', 'UserController@index')->name('user-index');

    Route::post('update/image', 'UserController@updateImage')->name('user-image-update');
    
    Route::post('update/password', 'UserController@updatePassword')->name('user-password-update');
    
    Route::get('myposts', 'PostsController@myPosts')->name('my-posts');

    Route::get('/create', 'UserController@getStrutureCreate')->name('user-create');
    Route::get('/edit', 'UserController@getStrutureEdit')->name('user-edit');
    Route::get('/profile', 'UserController@getStrutureEdit')->name('user-profile');

    Route::group(['prefix'=>'notification'], function(){
        Route::post('/get', 'NotificationsController@getNotification')->name('notification-get');
        Route::get('', 'NotificationsController@index')->name('notification-index');
        Route::post('/disable', 'NotificationsController@disable')->name('notification-disable');
    });
});

Route::get('auth/logout', 'Auth\LoginController@logout')->name('logout');

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


// Route::any('watermark', 'AdminController@waterMark')->name('water-mark');
Auth::routes(['verify' => true]);
