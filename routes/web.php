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

Route::get('', 'HomeController@index')->middleware('user_block')->name('index');

/* rotas de administradores. */ 
Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'user_is_admin', 'user_block']], function(){

    Route::get('/month/{month}/year/{year}', 'AdminController@index')->name('admin-index');

    Route::post('/user/disable/{id}', 'UserController@disableUser')->name('admin-user-disable');
    Route::post('/user/active/{id}', 'UserController@activeUser')->name('admin-user-active');

    Route::get('/listusers', 'UserController@getStrutureUsers')->name('admin-listusers');

    /* Rotas relacionadas a pagamentos. */ 
    Route::any('/payment/{id?}', 'PaymentController@getStruturePayment')->name('admin-new-payment');
    Route::post('/payments/store', 'PaymentController@payment')->name('admin-store-payment');
    Route::get('/month/{month}/year/{year}/openpayments', 'PaymentController@getStrutureOpenPayments')->name('admin-open-payments');
    Route::get('/month/{month}/year/{year}/closedpayments', 'PaymentController@getStrutureClosedPayments')->name('admin-closed-payments');
    
    Route::get('/purchase/getpurchases', 'PurchasesController@getPurchases')->name('purchases-getpurchases');

    
    Route::group(['prefix'=>'create'], function(){
        Route::get('/client', 'ClientController@getStrutureCreate')->name('admin-create-client-view');
        Route::post('/client/store', 'ClientController@store')->name('admin-store-client');
        Route::get('/purchase/{id?}', 'PurchasesController@getStrutureCreate')->name('admin-create-purchases');
        Route::post('/purchases/store', 'PurchasesController@store')->name('admin-store-purchases');
    });
    
    Route::group(['prefix'=>'edit'], function(){
        Route::get('/client/{id}', 'ClientController@getStrutureEdit')->name('admin-edit-client-view');
        Route::post('/client/update', 'ClientController@update')->name('admin-update-client');
        Route::get('/purchase/{id?}', 'PurchasesController@getStrutureCreate')->name('admin-edit-purchases');
        Route::post('/purchases/update', 'PurchasesController@update')->name('admin-update-purchases');
    });
});

/* Rotas de clientes. */ 
Route::group(['prefix'=>'client', 'middleware'=>['auth', 'user_block']], function(){
    Route::get('/month/{month}/year/{year}', 'ClientController@index')->name('client-index');

    /* Rotas de pagamentos e compras. */
    Route::get('/month/{month}/year/{year}/openpayments/{id?}', 'PaymentController@getStrutureOpenPayments')->name('client-open-payments');
    Route::get('/month/{month}/year/{year}/closedpayments/{id?}', 'PaymentController@getStrutureClosedPayments')->name('client-closed-payments');
    
    /* Busca as compras desse pagamento. */ 
    Route::get('/purchase/getpurchases', 'PurchasesController@getPurchases')->name('purchases-client-getpurchases');
});

Route::group(['prefix'=>'user', 'middleware'=>['auth', 'user_block']], function(){
    Route::get('', 'UserController@index')->name('user-index');

    Route::post('update/image', 'UserController@updateImage')->name('user-image-update');
    
    Route::post('update/password', 'UserController@updatePassword')->name('user-password-update');

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

Route::any('user/block', function(){
    return view('auth.verify-user-block');
})->name('user-block');


Route::get('getcoins','PaymentController@getCoins')->name('getcoins');

Route::any('coins', function(){
    return view('testes.search-coin-comparison');
});