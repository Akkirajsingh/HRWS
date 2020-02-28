<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
 protected $table = 'questions';
 public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['req_id','question','created_at','created_by'];

    public function requirementRelation() {
        return $this->belongsTo('App\Models\Requirement','req_id');
    }
       
}
