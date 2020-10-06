<?php

use App\Http\Controllers\Admin\ClassroomController;
use App\Http\Controllers\Admin\SchoolYearController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::apiResource('school-years', SchoolYearController::class);
    Route::apiResource('classrooms', ClassroomController::class);
});
