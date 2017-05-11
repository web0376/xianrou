<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::any('index/test','Home\IndexController@test');
Route::any('index/test2','Home\IndexController@test2');
Route::any('index/wxAuth','Home\IndexController@wxAuth');





Route::group(['middleware' => 'HomeLogin','namespace'=>'Home'], function () {
    Route::any('/','IndexController@index');
    Route::any('user/index','UserController@index');
    Route::any('user/weibo','UserController@weibo');
    Route::any('user/sellWeixin','UserController@sellWeixin');
    Route::any('user/weixinXiajia','UserController@weixinXiajia');
    Route::any('user/upload','UserController@upload');
    Route::any('user/weiboImgText','UserController@weiboImgText');
    Route::any('user/weiboVideo','UserController@weiboVideo');



    Route::any('weibo/delete','UserController@weiboDel');
    Route::any('weibo/top','UserController@weiboTop');
    Route::any('weibo/praise','UserController@praise');
    Route::any('winfo/{id}','UserController@weiboInfo');
    Route::post('weibo/do_msgSubmit','UserController@do_msgSubmit');
    Route::get('other/{id}','UserController@other');
    Route::any('weibo/report','UserController@report');
    Route::any('weibo/fans','UserController@fans');
    Route::any('weibo/addWeixin','UserController@addWeixin');
    Route::any('weibo/dashang/{id}','UserController@dashang');
    Route::any('user/edit','UserController@edit');
    Route::get('user/view/{id}','UserController@viewData');

    //发现
    Route::get('find/index','FindController@index');
    Route::get('find/nearby','FindController@nearby');









});




