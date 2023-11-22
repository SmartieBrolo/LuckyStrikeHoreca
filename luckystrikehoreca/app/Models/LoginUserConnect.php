<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginUserConnect extends Model
{
    protected $table = 'login_user_connect';
    protected $fillable = ['date', 'unique_identifier'];
}
