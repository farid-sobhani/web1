<?php


namespace Farid\User\Services;


class UserService
{
    public static function resetPassword($user,$password)
    {
        $user->password = bcrypt($password);
        $user->save;
   }

}
