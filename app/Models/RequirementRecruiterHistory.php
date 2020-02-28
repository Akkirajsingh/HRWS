<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementRecruiterHistory extends Model
{
 protected $table = 'req_recruiter_hist';
 public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['req_id','recruiter_id','created_at','created_by'];

}
