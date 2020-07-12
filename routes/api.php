<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::get('profiles', function (Request $request) {
        return $request->user()->profiles;
    });

    Route::post('profiles', function (Request $request) {
        $request->user()->profile_identifier = $request->identifier;
        $request->user()->save();

        return $request->user()->profile;
    });

    Route::get('profile', function (Request $request) {
        return $request->user()->profile;
    });
});