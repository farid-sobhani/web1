<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Farid\User\Models\User;
use Farid\User\Notifications\ResetPasswordNotification;
use Farid\User\Repositories\UserRepo;
use Farid\User\Services\VerifyCodeService;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function showLinkRequestForm()
    {
        return view('User::Front.passwords.email');
    }


    public function sendResetLinkEmail(Request $request)
    {
        $user = resolve(UserRepo::class)->findByEmail($request->email);
        if ($user) {

            $user->sendResetPasswordNotification();
            return view('User::Front.verify-code-reset-password')->with(['id' => $user->id]);

        }
        return back();
    }



}
