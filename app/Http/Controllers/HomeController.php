<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Entrust;
use App\Models\Requirement;
use App\Models\Client;
use App\Models\ClientContact;
use Config;
use Auth;

class HomeController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

    function goToHome(){

       if((Entrust::can('ADMIN_*')))
       {
          return redirect()->intended('admin/dashboard');
       }
       else if(Entrust::hasRole('ACCOUNT_MANAGER'))
       {

           $authId            =  Auth::user()->id;
           $pageSize          =  Config::get('constant.page_size');
           $where=[ ['deleted',0], ['status','!=','Closed by Cantaloupe'], ['status','!=','Closed by another vendor']];
           $requirementList = Requirement::with([
               'assignedRelation:id,name',
               'clientRelation:id,name',
               'contactRelation:id,contact_person',
               'commentRelation:req_id,comments,created_at,created_by'
           ])
           ->whereHas('clientRelation', function ($query) {
                   $query->where(['client_status' => 1, 'company_id' => session('company_id')]);
               })
           ->whereHas('contactRelation', function ($query) use ($authId) {
               $query->where(['assigned_to' => $authId, 'deleted' => 0]);
           })
           ->where($where)
           ->latest('updated_at')->paginate($pageSize);


          $client            = Client::where([ ['client_status',1],['company_id',session('company_id')] ]);
          $authId            = Auth::user()->id;
          $clientContactList = $client->join('client_contact','client_contact.client_id','clients.id')
                               ->where('deleted',0)
                               ->where('client_contact.assigned_to',$authId)
                               ->where('client_contact.id','!=',null)->where('client_contact.contact_person','!=',null)
                               ->select('clients.id as client_id','clients.name as client_name', 'client_contact.id as contact_id',
                                        'client_contact.contact_person as contact_person')->get()->toArray();

          $status = Config::get('constant.status');
          return view('pages.Dashboard.account_manager',compact('requirementList','clientContactList','status'));
      }
      else if(Entrust::hasRole('HR_LEAD'))
      {
          $authId = Auth::user()->id;
          $pageSize        =  Config::get('constant.page_size');
          $requirement     = Requirement::where([ ['deleted',0], ['status','!=','Closed by Cantaloupe'], 
                                                 ['status','!=','Closed by another vendor'], ['assigned_to',$authId]]);
          $requirementList = $requirement->with([
                           'assignedRelation:id,name',
                           'clientRelation:id,name',
                           'contactRelation:id,contact_person',
                           'skillsRelation:id,req_id,skill',
                           'questionsRelation:id,req_id,question',
                           'recruiterRelation:id,req_id,recruiter_id',
                            ])->latest()->paginate($pageSize);

          $role = Config::get('constant.hr_recruiter');
          $recruterList = getUserByRole($role);
          return view('pages.Dashboard.hr_lead',compact('requirementList','recruterList'));
      }
      else if(Entrust::hasRole('HR_RECRUITER'))
      {
          $authId = Auth::user()->id;
          $pageSize =  Config::get('constant.page_size');

          $where=[ ['deleted',0], ['status','!=','Closed by Cantaloupe'], ['status','!=','Closed by another vendor']];
          $requirementList = Requirement::with([
              'assignedRelation:id,name',
              'clientRelation:id,name',
              'contactRelation:id,contact_person',
              'skillsRelation:id,req_id,skill',
              'questionsRelation:id,req_id,question',
              'recruiterRelation:id,req_id,recruiter_id',
              'commentRelation:req_id,comments,created_at,created_by'
          ])
             ->whereHas('clientRelation', function ($query) {
                  $query->where(['client_status' => 1, 'company_id' => session('company_id')]);
              })
              ->whereHas('contactRelation', function ($query) use ($authId) {
                  $query->where(['deleted' => 0]);
              })
              ->whereHas('recruiterRelation', function ($query) use ($authId) {
                  $query->where(['recruiter_id' => $authId]);
              })
              ->where($where)
              ->latest('updated_at')->paginate($pageSize);

          $role = Config::get('constant.hr_recruiter');
          $recruterList = getUserByRole($role);
          return view('pages.Dashboard.hr_recruiter',compact('requirementList','recruterList'));
      }
      else{
          return view('pages.welcome');
      }  
    }
}
