<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequirementHistory extends Model
{
 protected $table = 'req_history';
 public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['req_id','state_change','updated_at','updated_by'];

}
