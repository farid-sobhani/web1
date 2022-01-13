<?php

Route::group(['middleware' => ['web' , 'auth' , 'verified']],function ($router){

    $router->resource('category',\Farid\Category\Http\Controllers\CategoryController::class);

});
