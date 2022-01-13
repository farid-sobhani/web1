<?php
Route::group(['middleware' => 'web'],function ($router){
    $router->resource('settlements',\Farid\Payment\Http\Controllers\SettlementController::class);
    $router->post('settlements/accept',[\Farid\Payment\Http\Controllers\SettlementController::class,'accept']);
});

