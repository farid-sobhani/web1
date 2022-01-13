<?php

namespace Farid\Course\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Farid\RolePermissions\Models\Permission;
use Farid\User\Models\User;

class CoursePolicy
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

    public function index(User $user)
    {
       return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
           $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES);

    }

    public function edit($user, $course)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;

        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_OWN_COURSES) &&  $course->teacher_id == $user->id;
    }
    public function change_confirmation_status($user)
    {
        if ($user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) return true;
        return null;
    }
}
