<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'code', 'province_id'];

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'id');
    }
    public function site()
    {
        return $this->hasMany('App\Models\Site', 'district_id', 'id');
    }
}
