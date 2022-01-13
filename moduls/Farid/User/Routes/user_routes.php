<?php
use \Farid\User\Http\Controllers\UserController;
Route::middleware(['web'])->group(function ($router){

    Auth::routes(['verify' => true]);
    Route::post('/verify/email',[\App\Http\Controllers\Auth\VerificationController::class,'verify'])
        ->name('verification.verify');

    Route::post('password/r',[\App\Http\Controllers\Auth\ResetPasswordController::class,'showResetForm'])
        ->name('password.r');

    $router->resource('user',UserController::class);
    $router->post('user/{user}/changeStatus/{status}',
        [UserController::class,'changeStatus'])
        ->name('user.changeStatus');
    $router->post('user/search',[UserController::class,'search'])
    ->name('user.search');
    $router->post('user/profileImage',[UserController::class,'profileImage'])
        ->name('user.profileImage');
    $router->get('logout',[\App\Http\Controllers\Auth\LoginController::class,'logout']);
});



Route::get('/ver',function (){
    return view('User::Front.verify');
});





