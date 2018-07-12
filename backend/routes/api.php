<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::get('reset-tokens', 'AuthController@getResetToken');
    Route::post('/user/verify', 'AuthController@verifyUser');
    Route::apiResource('user', 'UserController');
    Route::apiResource('profile', 'ProfileController');
    Route::apiResource('address', 'AddressController');
    Route::apiResource('logs', 'LogsController');
});
