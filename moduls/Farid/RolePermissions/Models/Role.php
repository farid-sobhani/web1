<?php


namespace Farid\RolePermissions\Models;


class Role extends \Spatie\Permission\Models\Role
{
    const ROLE_TEACHER = 'teacher';
    const ROLE_USER = 'user';
    static $roles = [
        self::ROLE_TEACHER => [
            Permission::PERMISSION_TEACH
        ]
    ];
}
