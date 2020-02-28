<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Request;
use App\Models\PasswordTokens;
use Validator;
use Session;
use Entrust;
use Auth;
use Mail;
use Config;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  function addUserPage(){
   $data=[];

   $dept=Config::get('constant.department');
   $designation=Config::get('constant.designation');

   //dd(Auth::user());
   //dd (Entrust::can('ADMIN_USER_ADD'));

   $data['dept']=$dept;
   $data['designation']=$designation;
   $data['roles']=get_roles();
   return view('pages.admin.user.add_user',['data' => $data]);
  }


   function addUser(){

        $inputData = Input::all();

        $rules = [
            'name'             => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'email'            => 'required|email',
            'display_name'     => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'mobile'           => 'required|unique:users|digits_between:4,18',
            //'designation'    => 'required|max:120',
        ];

        $messages = [
            'email.required'            =>  Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }
        else{
            $is_email_exists     = User::where(['email' => Input::get('email'),'user_status' => 1])->first();
            if(!empty($is_email_exists)){
                Session::flash('error-message', Lang::get('validation.unique', ['attribute' => 'email id']));
                return redirect()->back()->withInput();
            }

            $User = new User();
            $User->name               =    Input::get('name');
            $User->email              =    Input::get('email');
            $User->display_name       =    Input::get('display_name');
            $User->dept               =    Input::get('dept');
            //$User->designation        =    Input::get('designation');
            $User->mobile             =    Input::get('mobile');
            $User->password           =    bcrypt( trim(Input::get('user_password')) );
            $User->user_status        =    1;
            $User->company_id         =    session('company_id');
            $User->save();

            //--STORE USER ROLE INFO
            if(!empty(Input::get('user_role'))){
                foreach(Input::get('user_role') as $userRole){
                    $roleUser = new RoleUser();
                    $roleUser->user_id = $User->id;
                    $roleUser->role_id = $userRole;
                    $roleUser->save();
                }
            }

            $token=generateResetPwdToken($User->id,'2880'); //2 Days
            //--SEND MAIL
            $data = array('token'=>$token);
            Mail::send('emails.new_account', $data,
                function($message) use ($User){
                    $message->to($User->email)->subject (Lang::get('email.adduser_subject'));
                    $message->from(Lang::get('email.adduser_from_email'),Lang::get('email.adduser_from')); });

            session()->flash('success-message', Lang::get('admin.user_created') );
            return redirect()->route('admin.user-list');
        }
    }

    function editUserPage(Request $request){
        $data=[];
        $userRoles=[];

        $user_id=\Crypt::decrypt($request->get('user_id'));


        $userRolesDB=getUserRole($user_id);
        foreach ($userRolesDB as $userRole){
            $userRoles[]=$userRole['role_id'];
        }

        $dept=Config::get('constant.department');
        $designation=Config::get('constant.designation');

        $data['dept']=$dept;
        $data['designation']=$designation;
        $data['roles']=get_roles();
        $data['user']=getUserById($user_id);
        $data['user_role']=$userRoles;

 //dd($data);
        return view('pages.admin.user.edit_user',['data' => $data]);
    }


    function editUser(){

        $inputData = Input::all();
        $user_id=\Crypt::decrypt(Input::get('user_id'));

        $rules = [
            'name'             => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'email'            => 'required|email',
            'display_name'     => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'mobile'           => 'required|digits_between:4,18|unique:users,mobile,'. $user_id,
        ];

        $messages = [
            'email.required'            =>  Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }
        else{

            $User = User::find($user_id);
            $User->name               =    Input::get('name');
            $User->display_name       =    Input::get('display_name');
            $User->dept               =    Input::get('dept');
            $User->mobile             =    Input::get('mobile');
            //$User->designation        =    Input::get('designation');
            $User->save();


            //--STORE USER ROLE INFO
            RoleUser::where('user_id', $user_id)->forceDelete();
            if(!empty(Input::get('user_role')) && count(Input::get('user_role'))>=1){
                foreach(Input::get('user_role') as $userRole){
                    $roleUser = new RoleUser();
                    $roleUser->user_id = $user_id;
                    $roleUser->role_id = $userRole;
                    $roleUser->save();
                }
            }

            session()->flash('success-message', Lang::get('admin.user_updated') );
            return redirect()->route('admin.user-list');
        }
    }

    function deleteUser(){

        $user_id=\Crypt::decrypt(Input::get('user_id'));
        $User = User::find($user_id);
        $User->user_status=0;
        $User->email=$User->email.'-deleted';
        $User->save();
        return redirect()->back()->with('success-message', Lang::get('admin.user_deleted')); 
    }

    function searchUser(){
        $search=Input::get('search');

        $data  = getUserBySearch($search);

        if(count($data) == 0){
            session()->now('error-message', Lang::get('admin.user_search_empty') );
          $data=getUserArray();
        }
        return view('pages.admin.user.user-list',['data' => $data]);
    }
}


