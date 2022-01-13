<?php

use \Farid\Course\Http\Controllers\SeasonController;

Route::group(["namespace" => "Farid\Course\Http\Controllers", 'middleware' => ['web', 'auth', 'verified']], function ($router) {
    $router->patch('seasons/{season}/accept', [SeasonController::class,'accept]'])->name('seasons.accept');
    $router->patch('seasons/{season}/reject', [SeasonController::class,'reject]'])->name('seasons.reject');
    $router->post('seasons/{course}', [SeasonController::class,'store'])->name('seasons.store');
});
