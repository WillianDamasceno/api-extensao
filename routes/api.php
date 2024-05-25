<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response()->json(['message' => 'Hello World!']);
});

Route::group(['prefix' => 'vaccine'], function () {
    Route::post('/cat', function (Request $request) {
        return response()->json('cat');
    });

    Route::post('/dog', function (Request $request) {
        return response()->json('dog');
    });
});
