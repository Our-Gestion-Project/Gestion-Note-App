<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class SaisirController extends Controller
{

    function saisir_note(Request $request){
        $module_name = $request->input('module_name');
        $user_name = $request->input('user_name');
        $SESSION = $request->input('SESSION');
        $id_prof = Auth::id();

        $responsabilites_table = DB::table('responsabilites')
                ->where('user_id', '=', $id_prof);
                
        
        $module_id = $responsabilites_table->pluck('module_id');

        $session_id = $responsabilites_table->pluck('session_id');

        $etudiant = DB::table('notes')
                    ->where('module_id','=',$module_id)
                    ->where('session_id','=',$session_id)
                    ->join('etudiants','notes.etudiant_id','=','etudiants.id')
                    ->select('etudiants.id',
                     'etudiants.nom',
                      'etudiants.prenom',
                      'notes.cf_n',
                      'notes.tp_n',
                      'notes.mg_n'
                      )->get();

        $module_coef_tp = DB::table('modules')
                        ->where('modules.id','=',$module_id)
                        ->pluck('modules.coef_tp');
                    
        return view('Principale.Saisir',['SESSION'=>$SESSION,
            'module_name'=>$module_name,
            'user_name'=>$user_name,
            'etudiant'=>$etudiant,
            'module_coef_tp' => $module_coef_tp,
        ]);
    }

}
