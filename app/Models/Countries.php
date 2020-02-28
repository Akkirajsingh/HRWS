<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model 
{
	protected $table = 'countries';
   
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'phonecode',
    ];
}