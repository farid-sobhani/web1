<?php

namespace Farid\Payment\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Farid\RolePermissions\Models\Permission;
use Farid\User\Models\User;

class PaymentPolicy
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

    public function index($user)
    { dd(1);
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_PAYMENTS)) return true;
    }
}
