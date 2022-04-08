<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {

    // Classes route for CRUD
    Route::apiResource('participants', \App\Http\Controllers\Api\ParticipantsController::class);

    // Classes route for restore
    Route::patch('participants/{id}/restore',[\App\Http\Controllers\Api\ParticipantsController::class,'restore'])->name('participants.restore');
});
