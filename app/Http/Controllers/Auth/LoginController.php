<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Cookie;
use Hash;
use Request;
use Session;
use Validator;
use DB;

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


    public function showLoginForm(){
        if(!empty(session('user_id')))
         return redirect()->intended('/home');
        else
         return view('pages.Auth.login');
    }


    /**
     *
     * Manage frontend login
     *
     * @param null
     * @return void
     */
    public function Login()
    {
           $inputData = Input::all();

            $rules = [
                'login_email'             => 'required',
                'login_password'          => 'required'
            ];

            $messages = [
                'login_username.required'   =>  Lang::get('validation.user_name_required'),
                'login_password.required'   =>  Lang::get('validation.password_required')
            ];

            $validator = Validator:: make($inputData, $rules, $messages);

            if($validator->fails()){
                return redirect()-> back()
                    ->withInput()
                    ->withErrors( $validator );
            }
            else{
                $email      =   trim(Input::get('login_email'));
                $password   =   trim(Input::get('login_password'));

                //dd(Hash::make($password));

                if (Auth::attempt(['email' => $email, 'password' => $password, 'user_status' => 1])) {
                //if (Auth::attempt(['email' => $email, 'password' => $password])) {
                    Session::put('user_id', Auth::user()->id);
                    Session::put('display_name', Auth::user()->display_name);
                    Session::put('company_id',Auth::user()->company_id);
                    return redirect()->intended('/home');
                }
                else{
                 Session::flash('error-message', Lang::get('auth.failed'));
                 return redirect()-> back();
                }
            }
    }

    public function Logout(){
        Session::flush();
        Auth::logout();
        return redirect()->intended('/');
    }

}
