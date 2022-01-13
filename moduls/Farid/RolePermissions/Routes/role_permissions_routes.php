<?php
use Farid\RolePermissions\Http\Controllers\RolePermissionsController;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::get('role',function (){
//    \Spatie\Permission\Models\Permission::create([
//        'name' => 'manage role-permissions'
//    ]);
    $user = \Farid\User\Models\User::find(1);
//
//    $user->givePermissionTo('manage role_permissions');
//    $user->givePermissionTo('teach');
    $user->assignRole('teacher');
})->middleware('web');
Route::group(['middleware' => ['web' , 'auth' , 'verified']],function ($router){

    $router->resource('role-permissions',RolePermissionsController::class)->middleware('permission:manage role_permissions');
    $router->post('role-permissions/{id}/update',[RolePermissionsController::class,'update'])->name('update.role');

});
