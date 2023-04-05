<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpseclib3\Crypt\RC2;
use Session;
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

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
//            // The user is active, not suspended, and exists.
//        }

        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // protected function credentials(Request $request)
    // {
    //     Session::flash('message', "Your account is not activated or.");
    //     return [
    //         'email' => $request->{$this->username()},
    //         'password' => $request->password,
    //         'status' => 'active',
    //     ];
    // }
    
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        $credentials = $this->credentials($request);
        // This section is the only change
        if (Auth::validate($credentials)) {
            $user = Auth::getLastAttempted();
            if ($user->status == "active") {
                Auth::login($user, $request->has('remember'));
                return redirect()->route('home');
            } else {
                Session::flash('message', "Your account is not activated.");
                return redirect()->back();
            }
        }
        
        Session::flash('message', "Invalid Credentials, Your credentials does not match.");
        return redirect()->back();

    }

}
