<?php
use Farid\Payment\Http\Controllers\PaymentController;
Route::group(['middleware' => 'web'],function ($router){
    $router->get('/payments',[PaymentController::class,'index'])->name('payments.index');
    $router->get('/mypurchases',[PaymentController::class,'mypurchases'])->name('purchases.index');
    $router->any('/payments/callback',[PaymentController::class,'callback'])->name("payments.callback");

});
 Route::get('superadmin' , function (){

    \Farid\User\Models\User::find(1)->givePermissionTo('manage payments');
 });
