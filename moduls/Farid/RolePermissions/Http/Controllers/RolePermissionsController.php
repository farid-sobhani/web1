<?php


namespace Farid\RolePermissions\Http\Controllers;


use App\Http\Controllers\Controller;

use Illuminate\Http\Request;;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Farid\RolePermissions\Http\Requests\RoleRequest;
use Farid\RolePermissions\Http\Requests\RoleUpdateRequest;
use Farid\RolePermissions\Repositories\PermissionRepo;
use Farid\RolePermissions\Repositories\RoleRepo;


class RolePermissionsController extends Controller
{
    private $roleRepo;
    private $permissionRepo;

    public function __construct(RoleRepo $roleRepo,PermissionRepo $permissionRepo)
    {
        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index(PermissionRepo $permissionRepo)
    {
        $roles = $this->roleRepo->all();
        $permissions = $permissionRepo->all();
        return view('RoleViews::index', compact('roles', 'permissions'));
    }

    public function store(RoleRequest $request)
    {


        return  $this->roleRepo->create($request);

    }

    public function edit($roleId){
        $role = $this->roleRepo->findById($roleId);
        $permissions = $this->permissionRepo->all();
        return view('RoleViews::edit',compact('role','permissions'));

    }

    public function update(Request $request,$roleId)
    {

        $this->roleRepo->update($roleId,$request);
        return redirect(route('role-permissions.index'));

    }

    public function destroy($roleId)
    {
        $this->roleRepo->delete($roleId);
        return response()->json([
            'message' => 'با موفقیت حذف شد',

        ],200);

    }





}
