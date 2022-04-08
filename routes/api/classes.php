<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {

    // Classes route for CRUD
    Route::apiResource('classes', \App\Http\Controllers\Api\ClassesApiController::class);

    // Classes route for restore
    Route::patch('classes/{id}/restore',[\App\Http\Controllers\Api\ClassesApiController::class,'restore'])->name('classes.restore');
});
