<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    protected $fillable = ['etudiant_id', 'module_id', 'note_tp', 'note_cf', 'note_generale', 'etat'];

    public $timestamps = false;

    public function etudiant()
    {
        return $this->belongsTo('App\Models\Etudiant');
    }

    public function module()
    {
        return $this->belongsTo('App\Models\Module');
    }
}
