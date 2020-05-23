<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('/product/{id}/restore', 'ProductController@restore');
    Route::get('/product/trashed', 'ProductController@trashed');
    Route::resource('product', 'ProductController');
});
