<?php
use \Farid\Course\Http\Controllers\CourseController;
Route::group(["namespace" => "Farid\Course\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->resource('courses', 'CourseController');
    $router->patch('courses/{course}/accept', [CourseController::class,'accept'])->name('courses.accept');
    $router->patch('courses/{course}/reject', [CourseController::class,'reject'])->name('courses.reject');
    $router->patch('courses/{course}/lock', [CourseController::class,'lock'])->name('courses.lock');
    $router->get('courses/{course}/details', [CourseController::class,'details'])->name('courses.details');
    $router->post('courses/{course}/buy', [CourseController::class,'buy'])->name('courses.buy');
});
