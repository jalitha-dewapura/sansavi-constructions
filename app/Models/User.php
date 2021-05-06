<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Authenticatable implements CanResetPasswordContract
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    use CanResetPassword;

    protected $fillable = ['id', 'name', 'username', 'user_role_id', 'email', 'phone', 'email_verified_at', 'password'];

    public function userRole()
    {
        return $this->belongsTo('App\Models\UserRole', 'user_role_id', 'id');
    }
   
}
