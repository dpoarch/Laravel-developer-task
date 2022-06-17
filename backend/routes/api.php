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
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/notification/all', 'NotificationController@all')->name('notification');


    
// Auth / Register
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

//Newsletter
Route::get('newsletters', 'NewsletterController@index');
Route::get('newsletters/{id}', 'NewsletterController@show');

//Subscriber
Route::get('checkstatus/{id}', 'SubscribersController@showStatus');
Route::post('send_subscription', 'SubscribersController@SendSubscriber');
Route::post('confirm_subscription', 'SubscribersController@ConfirmSubscription');
Route::post('unsubscribe', 'SubscribersController@Unsubscribe');


Route::group([
  'middleware' => 'auth:api'
], function() {
    Route::get('logout', 'AuthController@logout');
    Route::get('user', 'AuthController@user');
    Route::get('/notification', 'NotificationController@index');

    Route::post('/notification', 'NotificationController@create');
    Route::put('/notification', 'NotificationController@edit');
    Route::delete('/notification/delete/{id}', 'NotificationController@destroy');
});

    

