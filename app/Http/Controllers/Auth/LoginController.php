<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


use App\User;
use Auth;
use Authy;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use function redirect;


class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $redirectToToken = '/auth/token';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

//    public function authenticated(Request $request, User $user)
//    {
//        if ($user->hasTwoFactorAuthenticationEnabled()) {
//            return $this->logoutRedirectToTokenEntry($request, $user);
//        }
//
//        return redirect()->intended($this->redirectPath());
//    }
//
//    protected function logoutRedirectToTokenEntry(Request $request, User $user)
//    {
//        Auth::ghard($this->getGuard())->logout();
//
//        $request->session()->put('authy', [
//            'user_id'   => $user->id,
//            'authy_id'  => $user->authy_id,
//            'using_sms' => false,
//            'remember'  => $request->has('remeber'),
//
//        ]);
//        if ($user->hasSmsFactorAuthenticationEnabled) {
//            try {
//                Authy::requestSms($user);
//
//            } catch (SmsRequestFailedException $e) {
//                return redirect()->back();
//            }
//
//            $request->session()->push('authy.using_sms', true);
//        }
//
//        return redirect($this->redirectTokenPath());
//
//    }
//
//    protected function redirectTokenPath()
//    {
//        return $this->redirectToToken;
//    }
    protected function authenticated(Request $request, User $user)
    {
        if ($user->hasTwoFactorAuthenticationEnabled()) {
            return $this->logoutAndRedirectToTokenEntry($request, $user);
        }

        return redirect()->intended($this->redirectPath());
    }

    protected function logoutAndRedirectToTokenEntry(Request $request, User $user)
    {
        Auth::logout();

        $request->session()->put('authy', [
            'user_id' => $user->id,
            'authy_id' => $user->authy_id,
            'using_sms' => false,
            'remember' => $request->has('remember'),
        ]);

        if ($user->hasSmsTwoFactorAuthenticationEnabled()) {
            try {
                Authy::requestSms($user);
            } catch (SmsRequestFailedException $e) {
                return redirect()->back();
            }

            $request->session()->push('authy.using_sms', true);
        }

        return redirect($this->redirectTokenPath());
    }

    protected function redirectTokenPath()
    {
        return $this->redirectToToken;
    }

}
