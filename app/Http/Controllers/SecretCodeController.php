<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SaisirController;

class SecretCodeController extends Controller
{
    public function saisir_code_secret($ids){
        return view('Principale.Code_Secret',['ids'=>$ids]);
    }

    public function verifier_information(Request $request, $ids)
    {
        $user = Auth::user();
        $module = $user->responsabilites()->first()->module;
        $code_secret_db = $module->code_secret;
    
        if($request->code_saisi == $code_secret_db){
            $module_name = $module->Intitule;
            $user_name = $user->name;
            $SESSION = ($ids == 1) ? "Normale" : "Rattrapage";
            return redirect()->action([SaisirController::class,'saisir_note'],
                ['SESSION' => $SESSION,
                'module_name' => $module_name,
                'user_name' => $user_name
            ]);
        }
        return redirect()
                ->back()
                ->with('error', 'Le code que vous avez saisi est incorrect.');
    }
    

}
