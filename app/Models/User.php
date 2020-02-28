<?php
namespace App;

use Illuminate\Support\Facades\Config;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Users;

class User extends Users
{
    protected $guarded = [] ;

    use EntrustUserTrait; // add this trait to your user model

    protected $table = 'users';
    //protected $fillable = ['*'];
    protected $primaryKey = 'id';

    public function roles()
    {
     return $this->belongsToMany(Config::get('entrust.role'), Config::get('entrust.role_user_table'), Config::get('entrust.user_foreign_key'), Config::get('entrust.role_foreign_key'))->where('roles.active', 1);
    }

}
