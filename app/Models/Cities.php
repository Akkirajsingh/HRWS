<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model 
{
   protected $table = 'cities';
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'state_id',
    ];
}