<?php

use App\Models\PermissionRole;
use App\Models\Client;
use App\Models\PasswordTokens;
use App\Role;
use App\Permission;
use App\User;
use App\Models\RoleUser;
use Carbon\Carbon;
use App\Models\ClientContact;
use App\Models\Countries;


if (! function_exists('get_roles')) {
    function get_roles()
    {
     $data =  Role::where('active',1)->orderBy('editable','asc')->get()->toArray();
     return $data;
    }
}

function getCustomRole(){
  $pageSize  =  Config::get('constant.page_size');
  $data =  Role::whereNotIn('editable',['0'])->paginate($pageSize);
  return $data;
}


/**
 * Get function for Clients list
 *
 * @param NIL
 * @return Array
 */
function getClientArray(){
    $status         =      ['client_status' => 1,'company_id' => session('company_id')];
    //$data           =      Client::where($status)->with('clientContact')->get()->toArray();
    $data           =      Client::where($status)->get()->toArray();
    return $data;
}

/**
 * Get function for Clients list
 *
 * @param Search Keyword
 * @return Array
 */
function getClientBySearch($search){
    $where         =      ['client_status' => 1,'company_id' => session('company_id')];
    //$data         =      Client::where($status)->with('clientContact')->get()->toArray();
    $data           =      Client::where($where)
        ->where(function($q) use ($search) {
            $q->where('name', 'like', $search.'%')
                ->orWhere('city', 'like', $search.'%')
                ->orWhere('country', 'like', $search.'%');
        })
        ->get()->toArray();
    return $data;
}

/**
 * Get function for Client Contacts list
 *
 * @param Search Keyword
 * @return Array
 */
function getClientContactBySearch($search,$rec){
    $where         =      ['client_id' => $rec,'deleted' => '0'];
    $data           =      ClientContact::where($where)
        ->where(function($q) use ($search) {
            $q->where('contact_person', 'like', $search.'%')
                ->orWhere('designation', 'like', $search.'%')
                ->orWhere('department', 'like', $search.'%')
                ->orWhere('email', 'like', $search.'%')
                ->orWhere('city', 'like', $search.'%')
                ->orWhere('country', 'like', $search.'%');
        })
        ->get()->toArray();
    return $data;
}

/**
 * Get function for Client contacts count
 *
 * @param company_id
 * @return Array
 */
function getClientContactCount($rec_id){
    $where_clause   =      ['client_id' => $rec_id,'deleted' => '0'];
    $data           =      ClientContact::where($where_clause)->count();
    return $data;
}

/**
 * Get function for Client contacts list
 *
 * @param company_rec_id
 * @return Array
 */
function getClientContactArray($rec_id){
    $where_clause   =      ['client_id' => $rec_id,'deleted' => '0'];
    $data           =      ClientContact::where($where_clause)->get()->toArray();
    return $data;
}

function getCompanyName($rec_id){
    $where_clause   =      ['id' => $rec_id];
    $data           =      Client::select('name')->where($where_clause)->get()->toArray();
    return $data[0]['name'];
}

/**
 * Get function for Permission List
 *
 * @param NIL
 * @return Array
 */
if (! function_exists('get_permission')) {
    function get_permission()
    {
        $data =  Permission::whereNotIn('name',['ADMIN_ALL'])->get()->toArray();
        //Permission::all()->toArray();
        return $data;
    }
}


/**
 * Get function for Users list
 *
 * @param NIL
 * @return Array
 */
function getUserArray(){
    $where_cond       =      ['user_status' => 1,'company_id' => session('company_id')];
    $pageSize         =      Config::get('constant.page_size');
    $data             =      User::where($where_cond)->paginate($pageSize);
    return $data;
}

function getUserBySearch($search){
$where_cond    =      ['user_status' => 1,'company_id' => session('company_id')];
$pageSize         =      Config::get('constant.page_size');
$data = User::where($where_cond)
        ->where(function($q) use ($search) {
              $q->where('name', 'like', $search.'%')
                ->orWhere('display_name', 'like', $search.'%')
                ->orWhere('email', 'like', $search.'%')
                ->orWhere('designation', 'like', $search.'%');
        })
        //->tosql();
        ->paginate($pageSize);
return $data;
}

function getRoleBySearch($search){
    $pageSize  =  Config::get('constant.page_size');
    $data = Role::where('name', 'like', $search.'%')
        ->orWhere('display_name', 'like', $search.'%')
        ->paginate($pageSize);
    return $data;
}

/**
 * Get function for Permissions based on filter
 *
 * @param search filter
 * @return Array
 */
function getPermissionBySearch($search){
    $data = Permission::where('name', 'like', $search.'%')
        ->orWhere('display_name', 'like', $search.'%')
        ->get()->toArray();
    return $data;
}

/**
 * Get function for Permissions based on Role id
 *
 * @param  Role ID
 * @return Array
 */
function getPermissionByRoleId($role_id){
    $where_cond     =      ['role_id' => $role_id];
    $data           =      PermissionRole::select('permission_id')
                            ->where($where_cond)->get()->toArray();
    return $data;
}

/**
 * Get function for Users by id
 *
 * @param user_id
 * @return Array
 */
function getUserById($user_id){
    $where_cond     =      ['id' => $user_id,'user_status' => 1,'company_id' => session('company_id')];
    $data           =      User::where($where_cond)->first()->toArray();

    return $data;
}

/**
 * Get function for ROle by Users by id
 *
 * @param user_id
 * @return Array
 */
function getUserRole($user_id){
    $where_cond     =      ['user_id' => $user_id];
    $data           =      RoleUser::select('role_id')->where($where_cond)->get()->toArray();

    return $data;
}

/**
 * Function to generate reset pwd token
 *
 * @param userId,expiryMinute
 * @return token
 */
function generateResetPwdToken($userId,$expiryMinute){
    //--Create token
    $created_at_date = date("Y-m-d H:i:s");
    $expired_at_date = Carbon::parse($created_at_date)->addMinute($expiryMinute)->format("Y-m-d H:i:s");
    $token = bin2hex(random_bytes(32));

    $token_model = new PasswordTokens();
    $token_model->user_id = $userId;
    $token_model->token = $token;
    $token_model->created_at = $created_at_date;
    $token_model->expired_at = $expired_at_date;
    $token_model->save();

    return $token;
}

/**
 * Get user by role
 * @return Array
 */
function getUserByRole($role){
    
    $where_cond     =    ['user_status' => 1, 'company_id' => session('company_id'), 'roles.name' => $role];
    $data = User::join('role_user', 'users.id', '=', 'role_user.user_id')
        ->join('roles', 'roles.id', '=', 'role_user.role_id')
        ->where($where_cond)
        ->select('users.id','users.name')
        ->get()->toArray();
    return $data;
}

/**
 * Get list of available countries
 * @return Array
 */
function getCountries(){
    $countries  =  Countries::select("id", "name", "phonecode")->get()->toArray();
    return $countries;
}

/**
 * Get list of contacts based on client_id
 * @return Array
 */
function getContacts($client_id){

    $contacts  =   ClientContact::where([ ['client_id', $client_id], ['deleted','!=' ,'1'] ])->get()->toArray();
    if($contacts){
        foreach ($contacts as $value) {
            $assignedTo = ($value['assigned_to']) ? User::where('id', $value['assigned_to'] )->value('id') : null;
            $data[] = ['id' => $value['id'] , 'contact_person' => $value['contact_person'], 'email'=> $value['email'],
            'designation'=>$value['designation'], 'mobile' =>$value['mobile'] , 'fax' =>$value['fax'], 'city'=> $value['city'],
            'address1'=>$value['address1'], 'address2'=>$value['address2'], 'assigned_to' => $assignedTo ];
        }
        return $data;    
    }
}

/**
 * convert to UTC
*/
function convertDateToUTC($format,$date){
     return $value = ($date) ? Carbon::createFromFormat($format, $date) : null;
}

/**
 * Get assigned recruiter name
*/
function assignedRecruiterName($id){

    $user = User::whereIn('id',$id)->pluck('name')->toArray();
    $user =implode(", ",$user);
    return $user;
}
