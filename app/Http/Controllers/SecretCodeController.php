<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SecretCodeController extends Controller
{
    public function saisir_code_secret($ids){
        return view('Principale.Code_Secret',['ids'=>$ids]);
    }

    public function verifier_information(Request $r,$ids){
        $id = Auth::id();
    
        $tables = DB::table('users')
                        ->join('responsabilites','users.id','=','responsabilites.user_id')
                        ->join('modules','module_id','=','responsabilites.module_id')
                        ->where('users.id','=',$id);

        $code_secret_db = $tables->pluck('modules.code_secret')
                        ->first();

        if($r->code_saisi == $code_secret_db){
            $module_name = $tables->pluck('modules.Intitule')
                           ->first();
            $user_name = $tables->pluck('users.name')
                            ->first();
            if($ids == 1){
                $SESSION ="Normale";
                return view('Principale.Saisir',['SESSION'=>$SESSION,'module_name'=>$module_name,'user_name'=>$user_name]);
            }    
                else{
                    $SESSION ="Rattrapage";
                    return view('Principale.Saisir',['SESSION'=>$SESSION,'module_name'=>$module_name,'user_name'=>$user_name]);
                }
        }
        else 
            return redirect()->back();

    }

}
