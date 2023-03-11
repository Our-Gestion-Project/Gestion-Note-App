<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Module extends Model
{
    protected $table = 'modules';

    protected $fillable = ['code', 'professeur_id', 'pourecentage_tp'];

    public $timestamps = false;
    
    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }


}
