<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaisirController extends Controller
{
    public function saisir_normale(){
        $SESSION = "Normale";
        return view('Principale.Saisir',['SESSION'=>$SESSION]);
    }

    public function saisir_rattrapage(){
        $SESSION = "Rattrapage";
        return view('Principale.Saisir',['SESSION'=>$SESSION]);
    }
}
