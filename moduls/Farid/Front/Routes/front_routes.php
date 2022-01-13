<?php
use \Farid\Front\Http\Controllers\FrontController;
Route::group(['middleware' => 'web'],function ($router){
    $router->get('/',[\Farid\Front\Http\Controllers\FrontController::class,'index']);
    Route::get('courses/{course}/lesson/{lesson?}',[FrontController::class,'singleCourse'])->name('courses.show');

});
