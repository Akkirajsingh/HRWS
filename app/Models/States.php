<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class States extends Model 
{
	protected $table = 'states';
   
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country_id',
    ];
}