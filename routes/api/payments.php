<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {

    // Classes route for CRUD
    Route::apiResource('payments', \App\Http\Controllers\Api\PaymentsController::class);

    // Classes route for restore
    Route::patch('payments/{id}/restore',[\App\Http\Controllers\Api\PaymentsController::class,'restore'])->name('payments.restore');
});
