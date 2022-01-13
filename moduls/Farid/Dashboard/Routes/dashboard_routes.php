<?php

use Farid\Dashboard\Http\Controllers\DashboardController;

Route::group(['namespace' => 'Farid\Dashboard\Http\Controllers','middleware' => ['web' , 'auth' , 'verified']],function ($router) {
    $router->get('/home', [DashboardController::class, 'home'])->name('homes');
});

