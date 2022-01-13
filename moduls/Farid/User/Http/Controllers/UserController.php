<?php


namespace Farid\User\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Farid\Common\Responses\AjaxResponses;
use Farid\RolePermissions\Repositories\RoleRepo;
use Farid\User\Http\Requests\UpdateRequest;
use Farid\User\Models\User;
use Farid\User\Repositories\UserRepo;

class UserController extends Controller
{
    public function index(UserRepo $userRepo)
    {
        $this->authorize('edit',User::class);
        $users = $userRepo->getAll();

        return view('User::Admin.index',compact('users'));

    }

    public function edit($id , UserRepo $userRepo , RoleRepo $roleRepo)
    {
        $this->authorize('edit',User::class);
        $user = $userRepo->findById($id);
        $roles = $roleRepo->all();

        return view('User::Admin.edit' , compact('user' , 'roles'));

    }

    public function update($id,UpdateRequest  $request,  UserRepo $userRepo )
    {
        $this->authorize('edit',User::class);
        $user = $userRepo->findById($id);
        $userRepo->update($user , $request);
        return redirect(route('user.index'));
    }

    public function destroy($id,UserRepo $userRepo){
        $this->authorize('edit',User::class);
        $user = $userRepo->findById($id);
        if ($user->delete()) {
            AjaxResponses::SuccessResponse();
        }
        AjaxResponses::FailedResponse();
    }

    public function changeStatus($id,$status,UserRepo $userRepo)
    {
        $this->authorize('edit',User::class);
        $user = $userRepo->findById($id);

        if ($user->status == $status) {
            AjaxResponses::FailedResponse();
        }

        $userRepo->changeStatus($user,$status);
        AjaxResponses::SuccessResponse();

    }

    public function search(Request $request , UserRepo $userRepo)
    {

        $this->authorize('edit',User::class);
       $users = $userRepo->search($request);

       return view('User::Admin.index',compact('users'));


    }

    public function profileImage(Request $request,UserRepo $userRepo)
    {
        //dd($request->file('image'));
        $userRepo->updateProfileImage($request->file('image'));
        return back();
    }



}
