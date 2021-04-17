<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasuringUnits extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'code', 'is_visible', 'is_active', 'measure_unit_id_parent'];

    public function item()
    {
        return $this->hasMany('App\Models\Items', 'measuring_unit_id', 'id');
    }

    public function children()
    {
        return $this->hasMany('App\Models\MeasuringUnits', 'measure_unit_id_parent', 'id');
    }
}

?>