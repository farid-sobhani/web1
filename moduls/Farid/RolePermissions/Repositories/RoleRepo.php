<?php


namespace Farid\RolePermissions\Repositories;


use Spatie\Permission\Models\Role;

class RoleRepo
{
    public function all()
    {
        return Role::all();

    }

    public function findById($id)
    {
        return Role::findById($id);

    }

    public function create($request)
    {
        return Role::create([
            'name' => $request->name
        ])->syncPermissions($request->permissions);

    }

    public function update($id,$request)
    {
       $role =  $this->findById($id);
       $role->name = $request->name;
       $role->syncPermissions($request->permissions);
       $role->save();
       return $role;

    }
    public function delete($id)
    {
        return Role::find($id)->delete();

    }
}
