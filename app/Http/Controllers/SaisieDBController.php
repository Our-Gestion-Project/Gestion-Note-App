<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Note;
use Illuminate\Http\Request;

class SaisieDBController extends Controller
{
    public function save(Request $request,$module_id)
    {
            $noteTp = $request->input('noteTp');
            $noteCf = $request->input('noteCf');
        
            foreach ($noteTp as $id => $value) {
                $etudiant = Etudiant::find($id);
                $note = $etudiant->notes()->where('module_id', $module_id)->first();
                if ($note) {
                    $note->TP_N = $value;
                    $note->CF_N = $noteCf[$id];
                    $note->save();
                }
            }
    }
    
}
