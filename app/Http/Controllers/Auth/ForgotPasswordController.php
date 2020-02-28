<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use DB;
use Hash;
use Illuminate\Support\Facades\Lang;
use Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
  /*  public function __construct()
    {
        $this->middleware('guest');
    }*/

    public function redirectResetPassword($token){
        $user_details = DB::table('user_token')
            ->where('token', $token)
            ->get()
            ->first();

        if(!empty(session('user_id'))){
            Session::flush();
            Auth::logout();
        }

        return view('pages.Auth.reset_password')->with('user_details', $user_details);
    }

    public function manageResetPassword(){
        $password = trim(Input::get('user_forgot_new_password'));
        if(empty($password) || strlen($password) <=5 ){
            $resp[] = array('status'=>201,'message'=>'Password condition not matched.');
            return json_encode($resp);
        }

        $password = Hash::make( trim(Input::get('user_forgot_new_password')) );

        $User = User::find(Input::get('user_id'));
        $User->email_verified_at = Carbon::now();
        $User->password = $password;
        $User->save();

        $resp[] = array('status'=>200,'message'=>'Your password has been changed successfully.');

        return json_encode($resp);
    }



    public function forgotPassword(){
        $mail_id = trim(Input::get('user_forgot_pass_email_id'));

        $ud = DB::table('users')
            ->where('email', $mail_id)
            ->where('user_status',1)
            ->get()
            ->first();

        if(!empty($ud)){

            $token=generateResetPwdToken($ud->id,'10'); //10 Minutes
            //--SEND MAIL
            $data = array('token'=>$token);
            Mail::send('emails.forgot_password', $data,
                function($message) use ($ud){
                    $message->to($ud->email)->subject (Lang::get('email.forgot_subject'));
                    $message->from(Lang::get('email.forgot_from_email'),Lang::get('email.forgot_from')); });

            $resp[] = array('status'=>200,'mail_sent'=>$mail_id);
            return json_encode($resp);
        }else{
            $resp[] = array('status'=>403,'wrong_mail'=>$mail_id);
            return json_encode($resp);
        }

    }
}
