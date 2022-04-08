<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth:api'], function () {

    // Classes route for CRUD
    Route::apiResource('invoices', \App\Http\Controllers\Api\InvoicesController::class);

    // Classes route for restore
    Route::patch('invoices/{id}/restore',[\App\Http\Controllers\Api\InvoicesController::class,'restore'])->name('invoices.restore');
});
