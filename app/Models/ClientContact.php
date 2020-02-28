<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientContact extends Model
{
  protected $table = 'client_contact';

  public function client(){
   return $this->belongsTo('App\Models\Client');
  }

}
