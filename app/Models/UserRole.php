<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name'];

    public function users()
    {
        return $this->hasMany('App\Models\User', 'User_role_id', 'id');
    }
}
