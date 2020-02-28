<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Models\Client;
use App\Models\ClientContact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Session;
use Entrust;
use Auth;
use Lang;
use Config;
use DB;


class ClientContactController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

 function getClientContactList(){
     $client_id=\Crypt::decrypt(Input::get('id'));

     $data=getClientContactArray($client_id);
     $company_name=getCompanyName($client_id);
     $company_id=Input::get('id');
     $role = Config::get('constant.account_manager');
     $account_managers = getUserByRole($role);   
     return view('pages.admin.client.contact_list',compact('data','company_name','company_id','account_managers'));
 }

 function searchClientContactList(){
     $search=Input::get('search');

     $client_id=\Crypt::decrypt(Input::get('id'));
     $company_id=Input::get('id');

     $data=getClientContactBySearch($search,$client_id);
     $company_name=getCompanyName($client_id);

    return view('pages.admin.client.contact_list',compact('data','company_name','company_id'));
 }

    function deleteContact(){
        $contact_id=\Crypt::decrypt(Input::get('client_id'));


        $client = ClientContact::find($contact_id);
        $client->deleted=1;
        $client->save();

        $client_id=\Crypt::encrypt($client->client_id);
        session()->flash('success-message', Lang::get('admin.contact_deleted') );
        return redirect()->route('admin.clientContact-list',['id' => $client_id]);
    }

    function editContactPage(Request $request){
        $contact_id=\Crypt::decrypt($request->get('id'));
        $clientContact = ClientContact::find($contact_id);
        $companyInfo = Client::where('id', $clientContact->client_id)->select('id', 'name')->first();
        $role = Config::get('constant.account_manager');
        $account_managers = getUserByRole($role);
        $stateId = ($clientContact->state) ? States::where('name', $clientContact->state)->value('id') : '';
        $cityId = ($clientContact->city) ? Cities::where('name', $clientContact->city)->value('id') : '';

        return view('pages.admin.client.clientContact_edit',['data' => $clientContact, 'account_managers' => $account_managers,
            'companyInfo' => $companyInfo, 'stateId' => $stateId, 'cityId'  => $cityId ]);
    }

    function editContact(){
        $inputData = Input::all();
        $contact_id=\Crypt::decrypt(Input::get('contact_id'));
        $CountryInfo = Countries::where('id', request('client_country'))->first();
        $selectedCountry = ($CountryInfo) ? $CountryInfo->name : null;
        $selectedPhoneCode = ($CountryInfo) ? $CountryInfo->phonecode : null;
        $clientState   = (Input::get('client_state')) ? States::where('id', Input::get('client_state'))->value('name') : null;
        $clientCity    = (Input::get('client_city')) ? Cities::where('id', Input::get('client_city'))->value('name') : null;


        $rules = [
            'client_name'      => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'client_email'     => 'required|email|max:120',
            'client_contactNo' => 'required|digits_between:4,18,|unique:client_contact,mobile,'. $contact_id,
            'client_country'   => 'required',
            'client_state'     => 'required',
            'client_city'      => 'required'
            //'mobile' => 'required|regex:/(01)[0-9]{9}/'
        ];

        $messages = [
            'email.required'            =>  \Illuminate\Support\Facades\Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }
        else{
            $assigned_to= Input::get('client_assigned_to') ? Input::get('client_assigned_to') : null;

            $where        =      ['deleted' => 0,'contact_person' => Input::get('client_name')];
            $count         =      ClientContact::where($where)->where('id', '!=' , $contact_id)->get()->count();
            if($count>=1){
                Session::flash('error-message', Lang::get('admin.contact_update_exist') );
                return redirect()-> back()
                    ->withInput()
                    ->withErrors( $validator );
            }

            $contact = ClientContact::find($contact_id);
            $contact->contact_person =    Input::get('client_name');
            $contact->assigned_to    =    $assigned_to;
            $contact->designation    =    Input::get('designation');
            $contact->email          =    Input::get('client_email');
            $contact->phone          =    Input::get('client_phone');
            $contact->fax            =    Input::get('client_fax');
            $contact->address1       =    Input::get('address1');
            $contact->address2       =    Input::get('address2');
            $contact->mobile         =    Input::get('client_contactNo');
            $contact->country        =    $selectedCountry;
            $contact->state          =    $clientState;
            $contact->city           =    $clientCity;
            $contact->isd_code       =    $selectedPhoneCode;
            $contact->place_id       =    Input::get('place_id');
            $contact->google_place   =    Input::get('address');
            $contact->save();

            $client_id=\Crypt::encrypt($contact['client_id']);

            Session::flash('success-message', Lang::get('admin.contact_updated') );
            return redirect()->route('admin.clientContact-list',["id" => $client_id]);
        }
    }

    public function setAccountManager(Request $request){

        try {
            $decrypted_contact_id =\Crypt::decrypt($request->contact_id);
            if(!empty($request->manager_id))
              $decrypted_manager_id =\Crypt::decrypt($request->manager_id);
            else
                $decrypted_manager_id =null;
            ClientContact::where('id', $decrypted_contact_id)->update([ 'assigned_to' =>  $decrypted_manager_id ]);

            $resp[] = array('status'=>200,'message'=>'Updated account manager successfully');
            return json_encode($resp);

            //return response()->json('Updated account manager successfully');
        } catch (Exception $ex) {
            session()->now('error-message', $ex->getMessage() );
        }
    }

    public function addContactPage(Request $request){
        $company_id=\Crypt::decrypt($request->get('id'));
        $companyInfo = Client::where('id', $company_id)->select('id', 'name')->first();
        $role = Config::get('constant.account_manager');
        $account_managers = getUserByRole($role);

        return view('pages.admin.client.clientContact_add',['account_managers' => $account_managers,
            'companyInfo' => $companyInfo]);
    }

    function addContact(){
        $inputData = Input::all(); 
        $CountryInfo = Countries::where('id', request('client_country'))->first();
        $selectedCountry = ($CountryInfo) ? $CountryInfo->name : null;
        $selectedPhoneCode = ($CountryInfo) ? $CountryInfo->phonecode : null;
        $clientState   = (Input::get('client_state')) ? States::where('id', Input::get('client_state'))->value('name') : null;
        $clientCity    = (Input::get('client_city')) ? Cities::where('id', Input::get('client_city'))->value('name') : null;

        $rules = [
            'client_name'      => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'client_email'     => 'required|email|max:120|unique:client_contact,email',
            'client_contactNo' => 'required|unique:client_contact,mobile|digits_between:4,18',
            'client_country'   => 'required',
            'client_state'     => 'required',
            'client_city'      => 'required'
            //'mobile' => 'required|regex:/(01)[0-9]{9}/'
        ];

        $messages = [
            'email.required'            =>  \Illuminate\Support\Facades\Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }
        else{
            $client_id=\Crypt::decrypt(Input::get('client_id'));
            $assigned_to= Input::get('client_assigned_to') ? Input::get('client_assigned_to') : null;

            $where        =      ['deleted' => 0,'contact_person' => Input::get('client_name'),'client_id'=>$client_id];
            $count         =      ClientContact::where($where)->get()->count();
            if($count>=1){
                Session::flash('error-message', Lang::get('admin.contact_update_exist') );
                return redirect()-> back()
                    ->withInput()
                    ->withErrors( $validator );
            }

            $contact = new ClientContact();
            $contact->contact_person =    Input::get('client_name');
            $contact->assigned_to    =    $assigned_to;
            $contact->client_id      =    $client_id;
            $contact->designation    =    Input::get('designation');
            $contact->email          =    Input::get('client_email');
            $contact->phone          =    Input::get('client_phone');
            $contact->fax            =    Input::get('client_fax');
            $contact->address1       =    Input::get('address1');
            $contact->address2       =    Input::get('address2');
            $contact->mobile         =    Input::get('client_contactNo');
            $contact->country        =    $selectedCountry;
            $contact->state          =    $clientState;
            $contact->city           =    $clientCity;
            $contact->isd_code       =    $selectedPhoneCode;
            $contact->deleted        =    0;
            $contact->place_id       =    Input::get('place_id');
            $contact->google_place   =    Input::get('address');
            $contact->save();

            $client_id=\Crypt::encrypt($contact['client_id']);

            Session::flash('success-message', Lang::get('admin.contact_updated') );
            return redirect()->route('admin.clientContact-list',["id" => $client_id]);
        }
    }

    public function getClientContact(){
        $where       =      ['client_status' => 1,'company_id' => session('company_id')];

        $clients = Client::select('id', 'name', 'email', 'website','logo_name')->where($where)->get();
        $role = Config::get('constant.account_manager');
        $account_managers = getUserByRole($role);
        $clientList=array();
        foreach ($clients as  $value) {
          $contactList = ($value['id']) ? getContacts($value['id']) : [];
          $contactsCount =  ($contactList ) ? count($contactList) : 0;
          $clientList[] = [ 'id'=> $value['id'], 'name'=>$value['name'], 'email'=> $value['email'], 
                            'website'=>$value['website'], 'counts' =>$contactsCount ,'contacts' => $contactList,
                            'logo_name'=>$value['logo_name'] ];
        }
        return view('pages.admin.client.client_contact', compact('clientList', 'account_managers'));
    }

    public function searchClientContact(){
        $search=Input::get('search');

        $where_cond  =  [
            'clients.client_status' => 1, 'clients.company_id' => session('company_id'),
            'client_contact.deleted' => 0,
        ];

        $data = DB::table('clients')
            ->leftjoin('client_contact', 'clients.id', '=', 'client_contact.client_id')
            ->where($where_cond)
            ->where(function($q) use ($search) {
                $q->where('clients.name', 'like', $search.'%')
                    ->orWhere('client_contact.contact_person', 'like', $search.'%');
            })
            ->distinct('clients.id')->select('clients.id')
            ->get()->toArray();

        $data = array_map(function ($value) {
            return (array)$value;
        }, $data);


        if(count($data)==0){
            session()->flash('error-message', Lang::get('requirement.search_notfound') );
            return $this->getClientContact();
        }

        $role = Config::get('constant.account_manager');
        $account_managers = getUserByRole($role);


        $clients = Client::select('id', 'name', 'email', 'website','logo_name')->wherein('id',$data)->get();
        foreach ($clients as  $value) {
            $contactList = ($value['id']) ? getContacts($value['id']) : [];
            $contactsCount =  ($contactList ) ? count($contactList) : 0;
            $clientList[] = [ 'id'=> $value['id'], 'name'=>$value['name'], 'email'=> $value['email'],
                'website'=>$value['website'], 'counts' =>$contactsCount ,'contacts' => $contactList,
                'logo_name'=>$value['logo_name']];
        }
        return view('pages.admin.client.client_contact', compact('clientList', 'account_managers'));
    }
}
