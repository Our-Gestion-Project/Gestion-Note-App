<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'module_id',
        'session_id',
        'CF_N',
        'TP_N',
        'MG_N',
        'CF_R',
        'MG_R',
    ];

    public $timestamps = false;
}
