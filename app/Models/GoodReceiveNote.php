<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GoodReceiveNote extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'note_id', 'description', 'received_date', 'created_by_id', 'updated_by_id'];

    public function note()
    {
        return $this->belongsTo('App\Models\MaterialRequestNote', 'note_id', 'id');
    }
}
