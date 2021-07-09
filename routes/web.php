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

Route::get('/home', 'HomeController@index')->middleware('verify_host')->name('home');

Route::any('/', 'PostsController@index')->middleware('verify_host')->name('index');

Route::any('/{title?}', 'PostsController@index')->middleware('verify_host')->name('index-type');

route::get('teste', function(){
    
    $teste = Storage::allFiles('mods/images');
    $teste1 = Storage::allFiles('user/img/perfil');
    $teste2 = Storage::allFiles('images/mods-principal');
    
    Storage::delete($teste);
    Storage::delete($teste1);
    Storage::delete($teste2);
});



Route::get('/post/{id}/{type?}/{title?}', 'PostsController@detail')->name('post-detail');

/*rotas de posts*/
Route::group(['prefix'=>'posts'], function(){

    Route::post('approved', 'PostsController@approvedPost')->name('post-approved');
    
    
    Route::get('/struture/create', 'PostsController@getStrutureCreate')->name('post-create-struture');
    
    Route::any('/getcategories', 'PostsController@getCategories')->middleware(['auth', 'verified'])->name('get-categories');
    
    Route::post('/create', 'PostsController@create')->middleware(['auth', 'verified'])->name('post-create');
    Route::get('/edit/{id}', 'PostsController@getStrutureEdit')->middleware(['auth', 'verified'])->name('post-edit');
    Route::post('/update/{id}', 'PostsController@edit')->middleware(['auth', 'verified'])->name('post-update');
    Route::post('/delete/{id}', 'PostsController@delete')->middleware(['auth', 'verified'])->name('post-delete');
});

Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'verified', 'verify_host']], function(){
    Route::get('', 'AdminController@index')->name('admin-index');

    Route::get('/mods/approved', 'AdminController@approved')->name('mod-approved');
    Route::get('/mods/not/approved', 'AdminController@notApproved')->name('mod-not-approved');

    Route::post('/user/disable/{id}', 'UserController@disableUser')->name('admin-user-disable');
    Route::post('/user/active/{id}', 'UserController@activeUser')->name('admin-user-active');

    Route::get('/listusers', 'UserController@getStrutureUsers')->name('admin-listusers');
});

Route::group(['prefix'=>'user', 'middleware'=>['auth', 'verified', 'verify_host']], function(){
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
        // Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
        // Route::get('/delete', 'CommentController@delete')->name('comments-delete');
    });
});


/*Rotas comentarios*/
Route::group(['prefix'=>'comments'], function(){
    Route::post('/create', 'CommentController@create')->name('comments-create');
    Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
    Route::post('/delete/{user_id}/{id}/{id_mod}/', 'CommentController@delete')->name('comments-delete');
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

/*Rotas para tratamento de imagem*/
Route::get('resize/{resize}/posts/images/{args}', function($resize,$args){
    $resize = explode('-', $resize);

    $img = Image::cache(function($image) use($args, $resize){
            $file = Storage::disk('local')->get("/posts/images/{$args}");
            $img = $image->make($file)->resize($resize[0], $resize[1]);
        },24000, true );

    return Image::make($img)->response('jpg', $resize[2]);
})->name('resize-image');

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
