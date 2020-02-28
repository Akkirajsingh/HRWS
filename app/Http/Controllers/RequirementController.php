<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

// Default
use App\Http\Requests\RequirementRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use Validator;
use Session;
use Entrust;
use Auth;
use Config;
use Carbon\Carbon;
use DB;

// Models
use App\User;
use App\Models\Requirement;
use App\Models\RequirementHistory;
use App\Models\Client;
use App\Models\ClientContact;
use App\Models\Skills;
use App\Models\Questions;
use App\Models\RequirementRecruiter;
use App\Models\RequirementRecruiterHistory;


class RequirementController extends Controller
{

    public function __construct()
    {
            $this->middleware('auth');
    }

    /**
     * Requirement add view
     */
    public function addRequirementPage($clientId, $contactId){

            $priorities = Config::get('constant.priority');
            $needBys = Config::get('constant.need_by');
            $needByTypes = Config::get('constant.need_by_type');
            $modeOfInterviews = Config::get('constant.mode_of_interview');
            $availability = Config::get('constant.local_availabilty');
            $role = Config::get('constant.hr_lead');
            $hrLeads = getUserByRole($role);
            $clientInfo = Client::where('id',$clientId)->select('id','name','logo_name')->first(); 
            $contactInfo = ClientContact::where('id', $contactId)->select('id','contact_person')->first(); 
            return view('pages.requirement.requirement_add',compact('priorities','needBys','needByTypes','modeOfInterviews','availability',
                        'clientInfo', 'contactInfo', 'hrLeads'));
    }
    
    /**
     * Requirement add store
     */
    public function addRequirement(RequirementRequest $request){

        try{
            $format = "m-d-Y";
            $requirement = new Requirement();
            $requirement->fill( Input::get() );
            $requirement->req_no = $this->setRequirementNumber();
            $requirement->company_id = session('company_id');
            $requirement->client_id =  \Crypt::decrypt(request('client_id'));
            $requirement->contact_id = \Crypt::decrypt(request('contact_id'));
            $requirement->submission_date = request('submission_date') ?  convertDateToUTC($format,request('submission_date')) : null;
            $requirement->start_date = request('start_date') ? convertDateToUTC($format,request('start_date')) : null;
            $requirement->lead_submit_date = (request('lead_submit_date')) ? convertDateToUTC($format,request('lead_submit_date')) : null;
            $requirement->status = ( request('assigned_to') ? "Assigned to HR_LEAD" : "Open" );
            $requirement->deleted = 0;
            $requirement->created_by = Auth::user()->id;
            $requirement->save();
            RequirementHistory::create(['req_id'=> $requirement->id,'state_change'=>'Open','updated_at'=>$requirement->updated_at,
                                        'updated_by'=>Auth::user()->name]);
            if(request('assigned_to')){
            RequirementHistory::create(['req_id'=> $requirement->id,'state_change'=>$requirement->status,
                                        'updated_at'=>$requirement->updated_at,'updated_by'=>Auth::user()->name]);
            }
            return redirect()->route('home')->with('success-message',"Requirement Added Successfully");
        }catch(Exception $ex){
            return redirect()->back()->with('error-message', $ex->getMessage());
        }
    }

    /**
     * Requirement edit view
     */
    public function editRequirementPage($id){

            $requirement = Requirement::findOrFail($id);
            $priorities = Config::get('constant.priority');
            $needBys = Config::get('constant.need_by');
            $needByTypes = Config::get('constant.need_by_type');
            $modeOfInterviews = Config::get('constant.mode_of_interview');
            $availability = Config::get('constant.local_availabilty');
            $role = Config::get('constant.hr_lead');
            $hrLeads = getUserByRole($role);  
            $clientInfo = Client::where('id', $requirement->client_id)->select('id','name','logo_name')->first(); 
            $contactInfo = ClientContact::where('id', $requirement->contact_id)->select('id','contact_person')->first(); 
            return view('pages.requirement.requirement_edit',compact('priorities','needBys','needByTypes','modeOfInterviews','availability',
                        'requirement','hrLeads','clientInfo','contactInfo'));
    }

    /**
     * Requirement edit update
     */
    public function editdRequirement(RequirementRequest $request){
        try{
            $format = "m-d-Y";
            $requirementId = \Crypt::decrypt(request('requirement_id'));
            $clientId = \Crypt::decrypt(request('client_id'));
            $contactId = \Crypt::decrypt(request('contact_id'));
            $requirement =  Requirement::findOrFail($requirementId);
            $requirement->fill( Input::get() );
            $requirement->company_id = session('company_id');
            $requirement->client_id = $clientId;
            $requirement->contact_id = $contactId;
            $requirement->submission_date = request('submission_date') ? convertDateToUTC($format,request('submission_date')) : null;
            $requirement->start_date = request('start_date') ? convertDateToUTC($format,request('start_date')) : null;
            $requirement->lead_submit_date = (request('lead_submit_date')) ? convertDateToUTC($format,request('lead_submit_date')) : null;
            $requirement->updated_by = Auth::user()->id;
            if($requirement->status != "Assigned to HR_RECRUITER")
               $requirement->status = ( request('assigned_to') ? "Assigned to HRLead" : "Open" );
            $requirement->update();
            RequirementHistory::create(['req_id'=>$requirement->id, 'state_change'=> $requirement->status,
                                        'updated_at'=>$requirement->updated_at,'updated_by'=>Auth::user()->name ]);
            return redirect()->route('home')->with('success-message',"Requirement Updated Successfully");
        }catch(Exception $ex){
            return redirect()->back()->with('error-message', $ex->getMessage());
        }
    }
    
    /**
     * Requirement delete
     */
    public function deleteRequirement($id){

            $requirementId = \Crypt::decrypt($id);
            $requirement   = Requirement::find($requirementId);
            $requirement->deleted=1;
            $requirement->status="Deleted";
            $requirement->save();
            RequirementHistory::create(['req_id' => $requirement->id, 'state_change'=>'Deleted',
                                        'updated_at'=>$requirement->updated_at, 'updated_by'=>Auth::user()->name ]);
            return redirect()->route('home')->with('success-message',"Requirement Deleted Successfully");
    }

    /**
     * Requirement status change
     */
    public function changeStatus(Request $request){
      
            $requirementId = \Crypt::decrypt(request('requirement_id'));
            $requirement   = Requirement::find($requirementId);
            $requirement->status = request('status');
            $requirement->save();
            RequirementHistory::create(['req_id' => $requirement->id, 'state_change'=>$requirement->status,
                                        'updated_at'=>$requirement->updated_at, 'updated_by'=>Auth::user()->name ]);
            return redirect()->route('home')->with('success-message',"Requirement Status Changed Successfully");
    }

    /**
     * Set requirement number
     */
    private function setRequirementNumber(){

           $count =  Requirement::count()+1;
           $RequestNumber = "REQ#".$count;
           return $RequestNumber;
    }

    /**
     * Add skill
     */
    public function addSkill(Request $request){
     
            $this->validate($request, ['field_name' => 'required|Max:30']);
            $requirementId = \Crypt::decrypt(request('requirement_id'));
            $skills = request('field_name');
            $current_date_time = Carbon::now()->toDateTimeString();
          
            foreach ($skills as  $data) {
            if($data && $data !=='')
            Skills::updateOrCreate(['req_id'=>$requirementId, 'skill'=>$data], ['created_at'=>$current_date_time,
                                    'created_by'=>Auth::user()->name ]);
            }
            if(!$data){
                return redirect()->back()->with('error-message', "Please add at least one skill");
            }
                return redirect()->route('home')->with('success-message',"Skill Added Successfully");
          
    }

    /**
     * Delete skill
     */
    public function deleteSkill(Request $request){
       
            $skill = Skills::findOrFail(request('skill_id'));
            $skill->delete();
            return redirect()->route('home')->with('success-message',"Skill Deleted Successfully");
    }

    /**
     * Add question
     */
    public function addQuestion(Request $request){

            $this->validate($request, ['field_name' => 'required|Max:100']);
            $requirementId = \Crypt::decrypt(request('requirement_id'));
            $questions = request('field_name');
            $current_date_time = Carbon::now()->toDateTimeString();
            foreach ($questions as  $question) {
            if($question && $question !=='')
            Questions::updateOrCreate(['req_id'=>$requirementId, 'question'=> $question],
                                      ['created_at'=>$current_date_time,'created_by'=>Auth::user()->name ]);
            }
            if(!$question){
                return redirect()->back()->with('error-message', "Please add at least one question");
            }
                return redirect()->route('home')->with('success-message',"Question Added Successfully");
            
    }

    /**
     * Delete question
     */
    public function deleteQuestion(Request $request){
        
            $questions = Questions::findOrFail(request('question_id'));
            $questions->delete();
            return redirect()->route('home')->with('success-message',"Question Deleted Successfully");
    }

    /**
     * Assign Recruiter
     */
    public function assignRecruiter(Request $request){
        try{
            $leadSubmitDate = Requirement::where('id',request('requirement_id'))->value('lead_submit_date');
            $date = ($leadSubmitDate) ? $leadSubmitDate :  Carbon::now()->addMonths(2)->format('m-d-Y');
            $request->validate([
              'assigned'=>'required',
              'recruiter_submission_date'=>'required|date_format:m-d-Y|before:'.$date,
            ]);

            $requirementId = request('requirement_id');
            $createdAt = Carbon::now()->toDateTimeString();
            $recruiterSubmitDate =  convertDateToUTC("m-d-Y",request('recruiter_submission_date'));

            if(is_array($request->assigned)){
            RequirementRecruiter::where('req_id', $requirementId)->delete();

            foreach ($request->assigned as  $value) {
            $requirementRecruiter = new RequirementRecruiter();
            $requirementRecruiter->req_id = $requirementId;
            $requirementRecruiter->recruiter_id = $value;
            $requirementRecruiter->created_at = $createdAt;
            $requirementRecruiter->created_by = Auth::user()->name;
            $requirementRecruiter->save();
            RequirementRecruiterHistory::create(['req_id'=>$requirementRecruiter->req_id,'recruiter_id'=>$requirementRecruiter->recruiter_id
                                                 ,'created_at'=>$createdAt, 'created_by'=> $requirementRecruiter->created_by]);
            }
            //Requirement status dependency Changes
            Requirement::where('id',$requirementId)->update(['status'=>'Assigned to HR_RECRUITER','req_submit_date'=>$recruiterSubmitDate]);
            RequirementHistory::create(['req_id'=>$requirementRecruiter->req_id,'state_change'=>"Assigned to HR_RECRUITER",
                                        'updated_at'=>$createdAt, 'updated_by'=> $requirementRecruiter->created_by]);
            return redirect()->route('home')->with('success-message',"Recruiter Assigned Successfully");
            }
        }catch(Exception $ex){
            return redirect()->back()->with('error-message', $ex->getMessage());
        }    
    }


    public function searchRequirement(){
        $search=Input::get('search');
        $pageSize          =  Config::get('constant.page_size');
        $authId            = Auth::user()->id;

        $where_cond  =  [
            'clients.client_status' => 1, 'clients.company_id' => session('company_id'),
            'client_contact.assigned_to' => $authId,'client_contact.deleted' => 0,
            ['requirement.deleted',0],['requirement.status','!=','Closed by Cantaloupe'], ['requirement.status','!=','Closed by another vendor']];

        $data = DB::table('clients')
            ->join('client_contact', 'clients.id', '=', 'client_contact.client_id')
            ->join('requirement', 'requirement.contact_id', '=', 'client_contact.id')
            ->where($where_cond)
            ->where(function($q) use ($search) {
                $q->where('clients.name', 'like', $search.'%')
                    ->orWhere('client_contact.contact_person', 'like', $search.'%')
                    ->orWhere('requirement.title', 'like', $search.'%')
                    ->orWhere('requirement.description', 'like', $search.'%');
            })
            ->select('requirement.id')
            ->get()->toArray();

        $data = array_map(function ($value) {
            return (array)$value;
        }, $data);

        $requirementList = Requirement::wherein('id',$data)
            ->with([
            'assignedRelation:id,name',
            'clientRelation:id,name',
            'contactRelation:id,contact_person',
            'commentRelation:req_id,comments,created_at,created_by'
        ])->latest('updated_at')->paginate($pageSize);

        $client            = Client::where([ ['client_status',1],['company_id',session('company_id')] ]);
        $authId            = Auth::user()->id;
        $clientContactList = $client
            ->join('client_contact','client_contact.client_id','clients.id')
            ->where('client_contact.assigned_to',$authId)
            ->where('client_contact.id','!=',null)->where('client_contact.contact_person','!=',null)
            ->select('clients.id as client_id','clients.name as client_name', 'client_contact.id as contact_id',
                'client_contact.contact_person as contact_person')->get()->toArray();

        $status = Config::get('constant.status');

        if(count($data)==0){
            session()->flash('error-message', Lang::get('requirement.search_notfound') );
            return redirect()->route('home');
        }
        else
          return view('pages.Dashboard.account_manager',compact('requirementList','clientContactList','status'));
    }

    public function postComment(){
        $inputData = Input::all();

        $rules = [
            'comment'             => 'required|max:400',
        ];

        $messages = [
            'comment.required'    =>  Lang::get('validation.email_required'),
        ];

        $validator = Validator:: make($inputData, $rules, $messages);
        if($validator->fails()){
            return redirect()-> back()
                ->withInput()
                ->withErrors( $validator );
        }

        $comment = new Comment();
        $comment->req_id         =    Input::get('req_id');
        $comment->comments       =    Input::get('comment');
        $comment->created_by     =    session('display_name');
        $comment->created_id     =    session('user_id');
        $comment->save();

        session()->flash('success-message', Lang::get('requirement.comment_created') );
        return redirect()->route('home');
    }

    public function searchLeadRequirement(){
        $search=Input::get('search');
        $pageSize          =  Config::get('constant.page_size');
        $authId            = Auth::user()->id;

        $where_cond  =  [
            'clients.client_status' => 1, 'clients.company_id' => session('company_id'),
            'client_contact.deleted' => 0,
            'requirement.assigned_to' => $authId,
            ['requirement.deleted',0],['requirement.status','!=','Closed by Cantaloupe'], ['requirement.status','!=','Closed by another vendor']];

        $data = DB::table('clients')
            ->join('client_contact', 'clients.id', '=', 'client_contact.client_id')
            ->join('requirement', 'requirement.contact_id', '=', 'client_contact.id')
            ->where($where_cond)
            ->where(function($q) use ($search) {
                $q->where('clients.name', 'like', $search.'%')
                    ->orWhere('client_contact.contact_person', 'like', $search.'%')
                    ->orWhere('requirement.title', 'like', $search.'%')
                    ->orWhere('requirement.description', 'like', $search.'%')
                    ->orWhere('requirement.priority', 'like', $search.'%');
            })
            ->select('requirement.id')
            ->get()->toArray();

        $data = array_map(function ($value) {
            return (array)$value;
        }, $data);

        $requirementList = Requirement::wherein('id',$data)
            ->with([
                'assignedRelation:id,name',
                'clientRelation:id,name',
                'contactRelation:id,contact_person',
                'skillsRelation:id,req_id,skill',
                'questionsRelation:id,req_id,question',
                'recruiterRelation:id,req_id,recruiter_id',
            ])->latest('updated_at')->paginate($pageSize);

        $role = Config::get('constant.hr_recruiter');
        $recruterList = getUserByRole($role);

        if(count($data)==0){
          session()->flash('error-message', Lang::get('requirement.search_notfound') );
          return redirect()->route('home');
        }
        else
          return view('pages.Dashboard.hr_lead',compact('requirementList','recruterList'));
    }


    public function searchRecruiterRequirement(){
        $title=Input::get('title');
        $location=Input::get('location');
        $skill=Input::get('skill');


        $pageSize          =  Config::get('constant.page_size');
        $authId            = Auth::user()->id;

        $where_cond  =  [
            'clients.client_status' => 1, 'clients.company_id' => session('company_id'),
            'client_contact.deleted' => 0,
            'req_recruiter.recruiter_id' => $authId,
            ['requirement.deleted',0],['requirement.status','!=','Closed by Cantaloupe'], ['requirement.status','!=','Closed by another vendor']];

        $data = DB::table('clients')
            ->join('client_contact', 'clients.id', '=', 'client_contact.client_id')
            ->join('requirement', 'requirement.contact_id', '=', 'client_contact.id')
            ->join('req_recruiter', 'req_recruiter.req_id', '=', 'requirement.id');

        if(!empty($skill))
            $data->join('skills', 'skills.req_id', '=', 'requirement.id');

        $data->where($where_cond);

            if(!empty($skill) && !empty($title) && !empty($location))
            $data->where(function($q) use ($title,$location,$skill) {
                $q->Where('requirement.title', 'like', $title.'%')
                    ->Where('requirement.location', 'like', $location.'%')
                    ->Where('skills.skill', 'like', $skill.'%');
            });
           elseif(!empty($title) && !empty($location))
               $data->where(function($q) use ($title,$location,$skill) {
                   $q->Where('requirement.title', 'like', $title.'%')
                     ->Where('requirement.location', 'like', $location.'%');
               });
            elseif(!empty($skill) && !empty($location))
                $data->where(function($q) use ($title,$location,$skill) {
                    $q->Where('skills.skill', 'like', $skill.'%')
                        ->Where('requirement.location', 'like', $location.'%');
                });
            elseif(!empty($title) && !empty($skill))
                $data->where(function($q) use ($title,$location,$skill) {
                    $q->Where('requirement.title', 'like', $title.'%')
                        ->Where('skills.skill', 'like', $skill.'%');
                });
           elseif(!empty($skill))
            $data->where(function($q) use ($title,$location,$skill) {
                $q->Where('skills.skill', 'like', $skill.'%');
            });
            elseif(!empty($title))
                $data->where(function($q) use ($title,$location,$skill) {
                    $q->Where('requirement.title', 'like', $title.'%');
                });
            elseif(!empty($location))
                $data->where(function($q) use ($title,$location,$skill) {
                    $q->Where('requirement.location', 'like', $location.'%');
                });
           else
               $data->where(function($q) use ($title,$location,$skill) {
                   $q->Where('requirement.title', 'like', $title.'%')
                       ->orWhere('requirement.location', 'like', $location.'%');
               });

            $result=$data->distinct('requirement.id')
            ->select('requirement.id')
            ->get()->toArray();

        $data = array_map(function ($value) {
            return (array)$value;
        }, $result);

        $requirementList = Requirement::wherein('id',$data)
            ->with([
                'assignedRelation:id,name',
                'clientRelation:id,name',
                'contactRelation:id,contact_person',
                'skillsRelation:id,req_id,skill',
                'questionsRelation:id,req_id,question',
                'recruiterRelation:id,req_id,recruiter_id',
            ])->latest('updated_at')->paginate($pageSize);

        if(count($data)==0){
            session()->flash('error-message', Lang::get('requirement.search_notfound') );
            return redirect()->route('home');
        }
        else
          return view('pages.Dashboard.hr_recruiter',compact('requirementList','title','location','skill'));
    }
}
