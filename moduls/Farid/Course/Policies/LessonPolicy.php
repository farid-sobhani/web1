<?php

namespace Farid\Course\Policies;

use Farid\Course\Models\Course;
use Farid\Course\Models\Lesson;
use Farid\RolePermissions\Models\Permission;
use Farid\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LessonPolicy
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

    public function create($user , $course){
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) || $course->teacher_id == $user->id;
    }

    public function destroy($user , $lesson)
    {
        return $user->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES) ||
            $lesson->course->teacher_id == $user->id;
    }


}
