<?php


namespace Farid\RolePermissions\Models;


class Permission extends \Spatie\Permission\Models\Permission
{
    const PERMISSION_MANAGE_CATEGORIES = 'manage categories';
    const PERMISSION_MANAGE_COURSES = 'manage courses';
    const PERMISSION_MANAGE_OWN_COURSES = 'manage own courses';
    const PERMISSION_MANAGE_ROLE_PERMISSIONS = 'manage role_permissions';
    const PERMISSION_MANAGE_USERS = 'manage user';
    const PERMISSION_TEACH = 'teach';
    const PERMISSION_MANAGE_PAYMENTS = 'manage payments';

    static $permissions = [
        self::PERMISSION_SUPER_ADMIN,
        self::PERMISSION_TEACH,
        self::PERMISSION_MANAGE_CATEGORIES,
        self::PERMISSION_MANAGE_ROLE_PERMISSIONS,
        self::PERMISSION_MANAGE_COURSES,
        self::PERMISSION_MANAGE_OWN_COURSES,
        self::PERMISSION_MANAGE_USERS,
        self::PERMISSION_MANAGE_PAYMENTS
    ];

    const PERMISSION_SUPER_ADMIN = 'super admin';
}
