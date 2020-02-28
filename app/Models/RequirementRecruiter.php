<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementRecruiter extends Model
{
 protected $table = 'req_recruiter';
 public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['req_id','recruiter_id','created_at','created_by'];
    

    public function requirementRelation() {
        return $this->belongsTo('App\Models\Requirement','req_id');
    }
       
}
