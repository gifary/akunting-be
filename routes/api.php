<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|w
*/

// nama kelas route harus plural

Route::group(['prefix' => 'v1','as'=>'api.'], function () {
    // urutkan dari text terpanjang ke terendah

    require __DIR__ .'/api/participants.php';
    require __DIR__ .'/api/payments.php';
    require __DIR__ .'/api/invoices.php';
    require __DIR__ .'/api/classes.php';

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('me',function (\Illuminate\Http\Request $request){
            return response()->json(\Illuminate\Support\Facades\Auth::user());
        });
    });
});
