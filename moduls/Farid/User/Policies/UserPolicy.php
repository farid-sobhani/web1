<?php

namespace Farid\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Farid\RolePermissions\Models\Permission;
use Farid\User\Models\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function edit($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_USERS)) {
            return true;
        }

    }

}
