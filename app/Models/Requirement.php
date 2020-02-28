<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Requirement extends Model
{
 protected $table = 'requirement';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'req_no', 'company_id', 'client_id', 'contact_id', 'priority', 'submission_date', 'title', 'description', 'location', 'sal_from',
        'sal_to', 'vacancy_no', 'need_by_no', 'need_by_type', 'duration', 'extendable', 'experience', 'start_date', 'reporting_name',
        'reporting_desg', 'reporting_email', 'reporting_contact', 'interview_mode', 'travelling', 'local_driving_license','local_exp',
        'local_availability', 'notice_period', 'leave_sal', 'assigned_to', 'status', 'no_of_cv', 'deleted', 'created_at',
        'created_by', 'updated_at', 'updated_by', 'lead_submit_date'
    ];

    
    /**
     * accessors
     */
    public function getSubmissionDateAttribute($value)
    {
       $date = ($value) ? Carbon::parse($value)->format("m-d-Y") : null;
       return $date;
    }

    public function getStartDateAttribute($value)
    {
       $date = ($value) ? Carbon::parse($value)->format("m-d-Y") : null;
       return $date;
    }

    public function getLeadSubmitDateAttribute($value)
    {
       $date = ($value) ? Carbon::parse($value)->format("m-d-Y") : null;
       return $date;
    }

    public function getCreatedAtAttribute($value)
    {
       $date = ($value) ? Carbon::parse($value)->format("m-d-Y") : null;
       return $date;
    }


    /**
     * Relations
     */

    public function assignedRelation() {
        return $this->belongsTo('App\User','assigned_to');
    }

    public function clientRelation() {
        return $this->belongsTo('App\Models\Client','client_id');
    }

    public function contactRelation() {
        return $this->belongsTo('App\Models\ClientContact','contact_id');
    }

    public function skillsRelation() {
        return $this->hasMany('App\Models\Skills','req_id');
    }

    public function questionsRelation() {
        return $this->hasMany('App\Models\Questions','req_id');
    }

    public function recruiterRelation() {
        return $this->hasMany('App\Models\RequirementRecruiter','req_id');
    }

    public function commentRelation() {
        return $this->hasMany('App\Models\Comment','req_id')->latest('created_at');
    }
}
