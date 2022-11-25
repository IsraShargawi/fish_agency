<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Agency;
use Session;
use Auth;

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
    protected $redirectTo = RouteServiceProvider::LOGIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
         ]);

        if (Auth::attempt(['email' => $request->email,'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('fish_types.index'));
        }


        return redirect()->back()->withInput($request->only('email', 'remember'));
    }


    public function showAgencyLoginForm()
    {
        return view('auth.agency-login');
    }

    public function agencyLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
         ]);

        $agency = Agency::where('email', $request->username)->first();
        if (!$agency) {
            return redirect()->back()->with('alert', 'Wrong username or password');
        }

        $checked = Hash::check($request->password, $agency->password);

        if ($checked) {
            session()->put('agency', $agency);
            return redirect('/agency-dashboard/agency_orders');
        }

        return redirect()->back()->with('alert', 'Wrong username or password');
    }


    public function reset_password(Request $request)
    {

        $admin = User::find(Auth::user()->id);
        $valid = Hash::check($request->old_password, $admin->password);
        if (!$valid) {
            return redirect()->back()->with('alert', 'wrong password');
        }

        if ($request->new_password == $request->confirm_password) {
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return redirect()->intended(route('sellers.index'));
        } else {
            return redirect()->back()->with('alert', 'error : confirm password mismatch');
        }
    }

    public function edit(Request $request)
    {
        $admin = User::find(Auth::user()->id);
        return view('admin-profile', compact('admin'));
    }

    public function profile_update(Request $request)
    {
        $input = $request->all();

        $admin = User::find(Auth::user()->id);

        $admin->update($input);

        if ($request->file('image')) {
            $image_name = md5($admin->id . "store" . $admin->id . rand(1, 1000));

            $image_ext = $request->file('image')->getClientOriginalExtension(); // example: png, jpg ... etc

            $image_full_name = $image_name . '.' . $image_ext;

            $uploads_folder =  getcwd() . '/uploads/';

            if (!file_exists($uploads_folder)) {
                mkdir($uploads_folder, 0777, true);
            }


            $request->file('image')->move($uploads_folder, $image_name  . '.' . $image_ext);


            $admin->image =  $image_full_name;

            $admin->save();
        }

        return redirect()->intended(route('sellers.index'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        session()->flush();
        return redirect('/admin-dashboard');
    }
}
