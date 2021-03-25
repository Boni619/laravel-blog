<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

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
  //protected $redirectTo = '/dashboard';

  /**
   * Create a new controller instance.
   *
   * @return void
   */


  protected $redirectTo = '/';

  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }


  // public function showLoginForm()
  // {
  //      return view('front-end.auth.login');
  //     // return view('auth.login');
  // }

  public function showAdminLoginForm()
  {

    // $user = User::where('email', 'admin@test.com')->first();

    // $user->assignRole(ROLE_SUPERADMIN);

    // $from = 'UTC';


    // $to =  'America/Los_Angeles';


    // $datePST = Carbon::now();
    // $datePST->setTimezone($to);



    // dd($datePST->toIso8601String());

    return view('admin.auth.login');
  }



  public function adminLogin(Request $request)
  {
    $this->validateLogin($request);

    if ($this->hasTooManyLoginAttempts($request)) {
      $this->fireLockoutEvent($request);
      return $this->sendLockoutResponse($request);
    }

    $checkUser = User::where('email', $request->email)->first();

    /*---------Check user is exist or not-----------*/
    if (empty($checkUser)) {
      return redirect()->back()->withInput($request->input())->withErrors('This email id does not exist in our system.');
    }

    if ($this->guard()->validate($this->credentials($request))) {
      $user = $this->guard()->getLastAttempted();

      if ($user->hasRole(ROLE_USER)) {
        return redirect()->back()->withInput($request->input())->withErrors(['active' => 'You are not authorized to access.']);
      }

      if ($user->status == STATUS_BLOCK) {
        $this->incrementLoginAttempts($request);
        return redirect()->back()->withInput($request->input())->withErrors(['active' => 'Your account is temporarily blocked please contact customer care.']);
      }
      // Make sure the user is active
      if ($user->status == STATUS_ACTIVE && $this->attemptLogin($request)) {

        // Send the normal successful login response
        if (Auth::user()->role == ROLE_SUPERADMIN) {
          return redirect()->intended('admin/dashboard');
        } else {
          return redirect()->back()->withInput($request->input())->withErrors('Your email address or password is wrong. Please try again.');
        }
      } else {
        $this->incrementLoginAttempts($request);
        return redirect()->back()->withInput($request->input())->withErrors('Your email address or password is wrong. Please try again.');
      }
    } else {
      return redirect()->back()->withInput($request->input())->withErrors('Your email address or password is wrong. Please try again.');
    }
  }

  public function login(Request $request)
  {
    $this->validateLogin($request);

    if ($this->hasTooManyLoginAttempts($request)) {
      $this->fireLockoutEvent($request);
      return $this->sendLockoutResponse($request);
    }

    $checkUser = User::where('email', $request->email)->first();



    /*---------Check user is exist or not-----------*/
    if (empty($checkUser)) {
      return redirect()->back()->withInput($request->input())->withErrors('This email id does not exist in our system.');
    }


    if ($this->guard()->validate($this->credentials($request))) {
      $user = $this->guard()->getLastAttempted();

      if ($user->hasRole(ROLE_SUPERADMIN)) {
        return redirect()->back()->withInput($request->input())->withErrors(['active' => 'You are not authorized to access.']);
      }


      if ($user->status == STATUS_INACTIVE) {
        $this->incrementLoginAttempts($request);
        return redirect()->back()->withInput($request->input())->withErrors(['active' => 'Your account is not activated please contact admin.']);
      }
      if ($user->status == STATUS_BLOCK) {
        $this->incrementLoginAttempts($request);
        return redirect()->back()->withInput($request->input())->withErrors(['active' => 'Your account is temporarily blocked please contact admin.']);
      }


      // Make sure the user is active
      if ($user->status == STATUS_ACTIVE && $this->attemptLogin($request)) {

        if (Auth::user()->role != ROLE_USER) {
          return redirect()->back()->withInput($request->input())->withErrors(['active' => 'You account is diactivated  please contact admin.']);
        }
        if (Auth::user()->role == ROLE_USER) {
          return redirect()->intended('dashboard');
        } else {
          return redirect()->back()->withInput($request->input())->withErrors('Your email address or password is wrong. Please try again.');
        }
      } else {
        $this->incrementLoginAttempts($request);
        return redirect()->back()->withInput($request->input())->withErrors('Your email address or password is wrong. Please try again.');
      }
    } else {
      return redirect()->back()->withInput($request->input())->withErrors('Your email address or password is wrong. Please try again.');
    }
  }

  public function logout(Request $request)
  {

    if (!empty($request->role)) {

      $this->guard()->logout();

      $request->session()->invalidate();

      return redirect('admin');
    } else {

      $this->guard()->logout();

      $request->session()->invalidate();

      return redirect('login');
    }
  }


  public function adminLogout(Request $request)
  {

    dd($request);

    $this->guard()->logout();

    $request->session()->invalidate();

    return redirect('admin');
  }
}
