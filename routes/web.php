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

Route::any('/', 'ModsController@index')->middleware('verify_host')->name('index');


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
    $teste1 = Storage::allFiles('user/img/perfil');
    $teste2 = Storage::allFiles('images/mods-principal');
    
    Storage::delete($teste);
    Storage::delete($teste1);
    Storage::delete($teste2);
});


/*rotas de mods*/
Route::group(['prefix'=>'mods','middleware'=> ['verify_host']], function(){
    Route::get('', 'ModsController@index')->name('mods-index');

    Route::post('approved', 'ModsController@approvedMod')->name('mods-approved');
    Route::get('mymods', 'ModsController@myMods')->name('mod-my-mods');
    Route::get('/detail/{id}', 'ModsController@detail')->name('mods-detail');
    
    Route::post('/store/images', 'ModsController@imageStorage')->middleware(['auth', 'verified'])->name('mods-store-images');
    
    Route::get('/struture/create', 'ModsController@getStrutureCreate')->name('mod-create-struture');
    
    Route::any('/getcategories', 'ModsController@getCategories')->middleware(['auth', 'verified'])->name('get-categories');
    Route::any('/gettags', 'ModsController@getTags')->middleware(['auth', 'verified'])->name('get-tags');

    Route::post('/download/{id}', 'ModsController@download')->name('download');

    Route::post('/create', 'ModsController@create')->middleware(['auth', 'verified'])->name('mods-create');
    Route::get('/edit/{id}', 'ModsController@getStrutureEdit')->middleware(['auth', 'verified'])->name('mods-edit');
    Route::post('/update/{id}', 'ModsController@edit')->middleware(['auth', 'verified'])->name('mods-update');
    Route::post('/delete/{id}', 'ModsController@delete')->middleware(['auth', 'verified'])->name('mods-delete');
    Route::delete('/delete/images/{id}', 'ModsController@deleteImage')->middleware(['auth', 'verified'])->name('mods-images-delete');
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

    Route::get('/create', 'UserController@getStrutureCreate')->name('user-create');
    Route::get('/edit', 'UserController@getStrutureEdit')->name('user-edit');
    Route::get('/profile', 'UserController@getStrutureEdit')->name('user-profile');
});


/*Rotas comentarios*/
Route::group(['prefix'=>'comments'], function(){
    Route::post('/create', 'CommentController@create')->name('comments-create');
    Route::get('/edit/{id}', 'CommentController@edit')->name('comments-edit');
    Route::post('/delete/{user_id}/{id}/{id_mod}/', 'CommentController@delete')->name('comments-delete');
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

/*Rotas de mods*/
Route::group(['prefix'=> 'gtav'], function(){
  Route::get('', 'GtavController@index')->name('index-gtav');  
  Route::get('/{category}/{tag?}', 'GtavController@search')->name('search-category-gtav-and-tag');  
});

Route::group(['prefix'=> 'gtaiv'], function(){
    Route::get('', 'GtaivController@index')->name('index-gtaiv');  
    Route::get('/{category}/{tag?}', 'GtaivController@search')->name('search-category-gtaiv-and-tag');  
});

Route::group(['prefix'=> 'gtasa'], function(){
    Route::get('', 'GtasaController@index')->name('index-gtasa');  
    Route::get('/{category}/{tag?}', 'GtasaController@search')->name('search-category-gtasa-and-tag');  
});

Route::group(['prefix'=> 'ets2'], function(){
    Route::get('', 'Ets2Controller@index')->name('index-ets2');  
    Route::get('/{category}/{tag?}', 'Ets2Controller@search')->name('search-category-ets2-and-tag');
});

Route::group(['prefix'=> 'assetocorsa'], function(){
    
});

Route::group(['prefix'=> 'models3d'], function(){
    Route::get('', 'Models3dController@index')->name('index-models3d');  
    Route::get('/{category}/{tag?}', 'Models3dController@search')->name('search-category-models3d-and-tag');
});
/*fim rotas de mods.*/

/*Rotas para tratamento de imagem*/
Route::get('resize/{resize}/mods/images/{args}', function($resize,$args){
    $resize = explode('-', $resize);

    $img = Image::cache(function($image) use($args, $resize){
            $file = Storage::disk('local')->get("/mods/images/{$args}");
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
