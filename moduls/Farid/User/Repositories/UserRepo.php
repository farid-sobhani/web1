<?php


namespace Farid\User\Repositories;


use Farid\Media\Services\MediaFileService;
use Farid\User\Models\User;

class UserRepo
{

    public function findByEmail($email)
    {

        return User::where('email' , $email)->first();

    }

    public function getTeachers()
    {
        return User::permission('teach')->get();

    }

    public function findById($id)
    {
        return User::find($id);
    }

    public function getAll()
    {

        return User::all();
    }
    public function getRole($user){

    }

    public function changeStatus($user , $status)
    {

        $user->status = "banned";

       $user->save();



    }
    public function update($user , $values){
        $user->update([
           'name' => $values->name,
           'email' => $values->email,
           'mobile' => $values->mobile,

        ]);
        $user->assignRole($values->role);
    }

    public function search($request)
    {
        $query = User::query();
        if ($request->name) $query->where('name',$request->name);
        if ($request->mobile) $query->where('mobile',$request->mobile);
        if ($request->email) $query->where('email',$request->email);

        return $query->get();


    }

    public function updateProfileImage($image)
    {
        if (auth()->user()->image) {
            auth()->user()->image->delete();
        }
        $media = MediaFileService::upload($image);
        auth()->user()->image_id = $media;
        auth()->user()->save();



    }


}
