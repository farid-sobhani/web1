<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Farid\User\Services\UserService;
use Farid\User\Services\VerifyCodeService;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {

        if (VerifyCodeService::check($request->id, $request->reset_code)) {
            auth()->loginUsingId($request->id);
            return view('User::Front.passwords.reset');
        }

        return back();


    }

    public function reset(Request $request)
    {
        UserService::resetPassword(auth()->user(),$request->password);
        return redirect('/home');
    }


}
