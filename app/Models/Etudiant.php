<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Etudiant extends Model
{

    protected $table = 'etudiants';
    
    protected $fillable = ['code', 'nom', 'prenom'];
    
    public $timestamps = false;
    
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }
    

}
    
