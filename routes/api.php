<?php
Route::group(['middleware' => 'auth.jwt'], function () {
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

    //user
    Route::get('getPersonalInfo', 'Api\UserController@getPersonalInfo');
});

Route::post('login', ['as' => 'login', 'uses' => 'Api\AuthController@login']);
Route::post('register', 'Api\AuthController@signup');