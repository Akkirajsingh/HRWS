<?php

namespace App\Http\Controllers\Admin;

use App\Models\PermissionRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Entrust;
use Session;


class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

  function getPermissionList(){
    $data['role']=getCustomRole();
    $data['permission']=get_permission();

   return view('pages.admin.permission.list_permission',['data' => $data]);
  }

   function searchPermission(){
        $search=Input::get('search');

        $data['role']=get_roles();
        $data['permission']  = getPermissionBySearch($search);
       if(empty($data['permission'])){
           session()->now('error-message', Lang::get('admin.search_empty') );
           $data['permission']=get_permission();
       }
        return view('pages.admin.permission.list_permission',['data' => $data]);
    }

   function assignPermission(){

        $role_id=\Crypt::decrypt(Input::get('role_id'));

       PermissionRole::where('role_id', $role_id)->forceDelete();
       if(!empty(Input::get('permission'))>=1){
           foreach(Input::get('permission') as $permission){
               $PermissionRole = new PermissionRole();
               $PermissionRole->permission_id = $permission;
               $PermissionRole->role_id = $role_id;
               $PermissionRole->save();
           }
       }
       $data['role']=getCustomRole();
       $data['permission']  = getPermissionBySearch('');

       session()->now('success-message', Lang::get('admin.permission_updated') );
       return view('pages.admin.permission.list_permission',['data' => $data]);
   }

   function fetchPermission(){
       $role_id=\Crypt::decrypt(Input::get('role_id'));

       $data=getPermissionByRoleId($role_id);

       $resp[] = array('status'=>200,'message'=>$data);

       return json_encode($resp);
   }
}
