<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordTokens extends Model
{
    protected $table="user_token";
    protected $fillable = [
        "user_id","token","expired_at","created_at"
    ];
}
