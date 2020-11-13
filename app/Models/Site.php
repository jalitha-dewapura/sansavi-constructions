<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'province_id', 'district_id', 'started_date', 'pm_id', 'qa_id', 'sk_id', 'po_id', 'description'];

    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'province_id', 'id');
    }
    public function district()
    {
        return $this->belongsTo('App\Models\District', 'district_id', 'id');
    }
    public function purchasingOfficer()
    {
        return $this->belongsTo('App\Models\User', 'po_id', 'id');
    }
    public function projectManager()
    {
        return $this->belongsTo('App\Models\User', 'pm_id', 'id');
    }
    public function quantitySurveyor()
    {
        return $this->belongsTo('App\Models\User', 'qs_id', 'id');
    }
    public function stockKeeper()
    {
        return $this->belongsTo('App\Models\User', 'sk_id', 'id');
    }
    public function materialRequestNotes()
    {
        return $this->hasMany('App\Models\MaterialRequestNote', 'site_id', 'id');
    }
}
