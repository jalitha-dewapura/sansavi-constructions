<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveNote extends Model
{
    use HasFactory;
     
    protected $fillable = ['id', 'note_id', 'is_approved', 'description', 'created_by_id', 'updated_by_id'];

    public function note()
    {
        return $this->belongsTo('App\Models\MaterialRequestNote', 'note _id', 'id');
    }
}
