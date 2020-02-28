<?php

namespace App\Http\Controllers\Admin;


use App\User;
use App\Models\Countries;
use App\Models\States;
use App\Models\Cities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\Models\Client;
use Validator;
use Session;
use Entrust;
use Auth;
use File;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function addClient(Request $request){

        $inputData     = Input::all();
        $clientCountry = (Input::get('client_country')) ? Countries::where('id', Input::get('client_country'))->value('name') : null;
        $clientState   = (Input::get('client_state')) ? States::where('id', Input::get('client_state'))->value('name') : null;
        $clientCity    = (Input::get('client_city')) ? Cities::where('id', Input::get('client_city'))->value('name') : null;

        $rules = [
            'client_name'               => 'required|regex:/^[\pL\s\-]+$/u|max:120',
            'client_email'              => 'required|email|unique:clients,email',
            'client_website'            => 'required|max:255',
            'client_contactNo'          => 'required|unique:clients,contact_no|digits_between:4,18',
            'logo_name'                 => 'mimes:jpg,png,jpeg',
            //'mobile' => 'required|regex:/(01)[0-9]{9}/'
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
            $is_client_exists     = Client::where(['name' => Input::get('client_name')])->first();
            if(!empty($is_client_exists)){
                Session::flash('error-message', Lang::get('validation.unique', ['attribute' => 'name']));
                return redirect()->back()->withInput();
            }

            $Client = new Client();
            $Client->name               =    Input::get('client_name');
            $Client->email              =    Input::get('client_email');
            $Client->website            =    Input::get('client_website');
            $Client->contact_no         =    Input::get('client_contactNo');
            $Client->contact_person     =    Input::get('client_contactPerson');
            $Client->client_status      =    1;
            $Client->company_id         =    session('company_id');
            $Client->address1           =    Input::get('address1');
            $Client->address2           =    Input::get('address2');
            $Client->country            =    $clientCountry;
            $Client->state              =    $clientState;
            $Client->city               =    $clientCity;
            $Client->save();

            if($request->logo_name){
                    $image = $request->file('logo_name');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $uploadPath = public_path().'/images/clients';
                    $image->move($uploadPath, $filename);
                    Client::where('id', $Client->id)->update(['logo_name'=> $filename]);
            }

            Session::flash('success-message', Lang::get('admin.client_created') );
            return redirect()->route('admin.client-list');
        }
    }

    function getClientList(){
        $data=getClientArray();

        $itr=0;
        foreach ($data as $client){
            $data[$itr]['contact_count']=getClientContactCount($client['id']);
            $itr++;
        }
        return view('pages.admin.client.list-client',compact('data'));
    }

    function searchClient(){
        $search=Input::get('search');

        $data=getClientBySearch($search);
        if(empty($data)){
            session()->now('error-message', Lang::get('admin.search_empty') );
            $data=getClientArray();
        }

        $itr=0;
        foreach ($data as $client){
            $data[$itr]['contact_count']=getClientContactCount($client['id']);
            $itr++;
        }
        return view('pages.admin.client.list-client',compact('data'));
    }

    function deleteClient(){
        $client_id=\Crypt::decrypt(Input::get('client_id'));

        $client = Client::find($client_id);
        $client->client_status=0;
        $client->save();

        Session::flash('success-message', Lang::get('admin.client_deleted') );
        return redirect()->route('admin.client-list');
    }

    function editClientPage(Request $request){
      $client_id=\Crypt::decrypt($request->get('id'));
      $client = Client::find($client_id);
      $stateId = ($client->state) ? States::where('name', $client->state)->value('id') : '';
      $cityId = ($client->city) ? Cities::where('name', $client->city)->value('id') : '';

      return view('pages.admin.client.client_edit',['data' => $client, 'stateId' => $stateId , 'cityId' => $cityId ]);
    }

    function editClient(Request $request){

        $inputData = Input::all();
        $client_id=\Crypt::decrypt(Input::get('client_id'));
        $clientCountry = (Input::get('client_country')) ? Countries::where('id', Input::get('client_country'))->value('name') : null;
        $clientState   = (Input::get('client_state')) ? States::where('id', Input::get('client_state'))->value('name') : null;
        $clientCity    = (Input::get('client_city')) ? Cities::where('id', Input::get('client_city'))->value('name') : null;

        $rules = [
                'client_name'               => 'required|regex:/^[\pL\s\-]+$/u|max:120',
                'client_email'              => 'required|email|unique:clients,email,'.$client_id,
                'client_website'            => 'required|max:100',
                'client_contactNo'          => 'required|digits_between:4,18|unique:clients,contact_no,'. $client_id,
                'logo_name'                 => 'mimes:jpg,png,jpeg',
                //'mobile' => 'required|regex:/(01)[0-9]{9}/'
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

            $where        =      ['client_status' => 1,'company_id' => session('company_id'), 'name' => Input::get('client_name')];
            $count         =      Client::where($where)->where('id', '!=' , $client_id)->get()->count();
            if($count>=1){
                session()->now('error-message', Lang::get('admin.client_update_exist') );
                return redirect()-> back()
                    ->withInput()
                    ->withErrors( $validator );
            }
           
           $requestedData = [ 'name' => Input::get('client_name'), 'email' => Input::get('client_email'), 'client_status' => 1,
                              'website' => Input::get('client_website'), 'contact_no' => Input::get('client_contactNo'),
                              'contact_person' => Input::get('client_contactPerson'), 'company_id' => session('company_id'), 
                              'address1' => Input::get('address1'), 'address2' => Input::get('address2'), 'country' => $clientCountry,
                              'state' => $clientState, 'city' => $clientCity 
                            ];

            $client = Client::where('id', $client_id)->update($requestedData);
            if($request->logo_name){
                    $image = $request->file('logo_name');
                    $filename = time() . '.' . $image->getClientOriginalExtension();
                    $uploadPath = public_path().'/images/clients';
                    $image->move($uploadPath, $filename);
                    Client::where('id', $client_id)->update(['logo_name'=> $filename]);
            }
            Session::flash('success-message', Lang::get('admin.client_updated') );
            return redirect()->route('admin.client-list');
        }
    }

    public function deleteLogo(Request $request){
        
        $client_id = \Crypt::decrypt(request('client_id'));
        $client = Client::findOrFail($client_id);
        $image_path = public_path().'/images/clients/'.$client->logo_name; 
        if(File::exists($image_path)) {
            File::delete($image_path);
            Client::where('id', $client_id)->update(['logo_name'=> null]);
            return redirect()->back()->with('success', 'Deleted Successfully');
        }
    }

}
