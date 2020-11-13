<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Items extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'code', 'name', 'price', 'measuring_unit_id', 'description', 'is_consumable', 'created_by_id', 'updated_by_id'];

    public function measuringUnit()
    {
        return $this->belongsTo('App\Models\MeasuringUnits', 'measuring_unit_id', 'id');
    }
    public function requestMaterials()
    {
        return $this->hasMany('App\Models\RequestMaterials', 'item_id', 'id');
    }
}
