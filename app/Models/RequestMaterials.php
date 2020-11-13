<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestMaterials extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['id', 'node_id', 'item_id', 'quantity', 'cost', 'description'];

    public function item()
    {
        return $this->belongsTo('App\Models\Items', 'item_id', 'id');
    }

    public function note()
    {
        return $this->belongsTo('App\Models\MaterialRequestNote', 'node_id', 'id');
    }
}
