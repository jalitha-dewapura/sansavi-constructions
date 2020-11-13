<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialRequestNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'note_date', 'site_id', 'is_urgent', 'is_complete', 'is_approved', 'delivery_date', 'description', 'created_by_id', 'updated_by_id'];

    public function materials()
    {
        return $this->hasMany('App\Models\RequestMaterials', 'note_id', 'id');
    }
    public function site()
    {
        return $this->belongsTo('App\Models\Site', 'site_id', 'id');
    }
    public function goodReceiveNote()
    {
        return $this->hasOne('App\Models\GoodReceiveNote', 'note_id', 'id');  
    }
    public function approveNote()
    {
        return $this->hasOne('App\Models\ApproveNote', 'note_id', 'id');
    }

}
