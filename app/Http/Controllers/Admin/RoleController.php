<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionRole;
use App\Models\RoleUser;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Validator;
use Session;
use Entrust;


class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function getRoleList(){
        return view('pages.admin.role.list_role',['data' => getCustomRole()]);
    }

    function addRole(){
        $inputData = Input::all();

        $rules = [
            'role'  => 'required|alpha|min:4:max:15'
        ];

        $messages = [
            'email.required'    =>  Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }

            $where = [
              'name' => trim(strtoupper(Input::get('role')))
            ];
            $is_role_exists     = Role::where($where)->first();
            if(!empty($is_role_exists)){
                Session::flash('error-message', Lang::get('validation.unique', ['attribute' => 'role']));
                return redirect('admin/role');
            }
            $Role = new Role();
            $Role->name               =    trim(strtoupper(Input::get('role')));
            $Role->display_name       =    Input::get('role');
            $Role->save();

            Session::flash('success-message', Lang::get('admin.role_created') );
            return redirect('admin/role');
        }

    function updateRole(){
        $inputData = Input::all();

        $rules = [
            'role_value'  => 'required|alpha|min:4:max:15'
        ];

        $messages = [
            'email.required'    =>  Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }

        $role_id=\Crypt::decrypt(Input::get('role_id'));

        $where = [
            'name' => trim(strtoupper(Input::get('role_value')))
        ];
        $is_role_exists     = Role::where($where)
                                ->whereNotIn('id', [$role_id])
                                ->first();
        if(!empty($is_role_exists)){
            Session::flash('error-message', Lang::get('validation.unique', ['attribute' => 'role']));
            return redirect('admin/role');
        }
        $Role = Role::find($role_id);
        $Role->name               =    trim(strtoupper(Input::get('role_value')));
        $Role->display_name       =    Input::get('role_value');
        $Role->save();

        Session::flash('success-message', Lang::get('admin.role_updated') );
        return redirect('admin/role');
    }

    function searchRole(){
        $search=Input::get('search');

        $data  = getRoleBySearch($search);
        if(count($data) == 0){
            session()->now('error-message', Lang::get('admin.search_empty') );
            $data=getCustomRole();
        }
        return view('pages.admin.role.list_role',['data' => $data]);
    }

   function deleteRole(){
        $role_id=\Crypt::decrypt(Input::get('id'));

       PermissionRole::where('role_id', $role_id)->forceDelete();
       RoleUser::where('role_id', $role_id)->forceDelete();
       Role::where('id', $role_id)->forceDelete();
       return redirect()->back()->with('success-message',  Lang::get('admin.role_deleted')); 
   }

    function roleToggle(){
        $role_id=\Crypt::decrypt(Input::get('id'));

        $Role = Role::find($role_id);
        if($Role->active==1)
          $Role->active=0;
        else
          $Role->active=1;
        $Role->save();

        $resp[] = array('status'=>200,'message'=>'Success');

        return json_encode($resp);
    }

}
