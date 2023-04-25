<?php
namespace App\Http\Controllers;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class SaisieDBController extends Controller
{
    public function save(Request $request) 
    { 
        $noteTp = $request->input('noteTp'); 
        $noteCf = $request->input('noteCf'); 
        $moyen = $request->input('moyen'); 
        $module_id = $request->input('module_id'); 
        $Session = $request->input('Session') == "Normale" ? 1 : 2; 
        $user = $request->input('user'); 

        foreach ($noteCf as $id => $value) 
        { 

            $etudiant = Etudiant::find($id); 
            $note = $etudiant->notes()->where('module_id', $module_id)->first(); 

            
            if ($note && $note->user_id==null) 
            { 
                if ($Session == 1) 
                { 
                    if ($noteCf[$id] != null ) { 
                        $note->CF_N = $value; 
                        $note->TP_N = $noteTp[$id] ?? null ;
                        $note->user_id = $user;
                    }
                } 
                else 
                { 
                    if ($noteCf[$id] != null) { 
                        $note->CF_R = $noteCf[$id];
                        $note->user_id = $user; 
                    }
                } 

                $note->save(); 
            } 
        } 

        return redirect()->back(); 
    }

}