<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'code'];
    
    public function districts()
    {
        return $this->hasMany('App\Models\District', 'province_id', 'id');
    }

    public function site()
    {
        return $this->hasMany('App\Models\Site', 'province_id', 'id');
    }
}
