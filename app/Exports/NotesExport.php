<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class NotesExport implements FromCollection, WithStrictNullComparison, WithHeadings, WithMapping
{

    public function collection()
    {
        $id = Auth::id();
        $responsabilites_table = DB::table('responsabilites')
            ->where('user_id', '=', $id)
            ->first();

            return DB::table('notes')
            ->join('etudiants', 'notes.etudiant_id', '=', 'etudiants.id')
            ->where('notes.module_id', '=', $responsabilites_table->module_id)
            ->where('notes.session_id', '=', $responsabilites_table->session_id)
            ->select(
                'etudiants.id',
                'etudiants.nom',
                'etudiants.prenom',
                'etudiants.CNE',
                'etudiants.CNI',
                'notes.CF_N',
                'notes.TP_N',
                'notes.MG_N',
                'notes.CF_R',
                'notes.MG_R',
                'notes.id as note_id')
                ->get();
        
    }

    public function headings(): array {
        return [
            'Code Etudiant',
            'Nom Etudiant',
            'Prenom Etudiant',
            'CNE Etudiant',
            'CNI Etudiant',
            'Controle Finale Normale',
            'Controle Tp Normale',
            'Moyen Generale Normale',
            'Controle Finale Rattrapage',
            'Moyen Generale Rattrapage',
            'etat'
        ];
    }

    public function map($row): array {
        $note_id = $row->note_id;
        $MG_N = DB::table('notes')->where('id', '=', $note_id)->value('MG_N');
        $MG_R = DB::table('notes')->where('id', '=', $note_id)->value('MG_R');
    
        if ($MG_N !== null && $MG_N >= 10) {
            $etat = 'Valide';
        } elseif ($MG_N !== null && $MG_N < 10 && $MG_R === null) {
            $etat = 'Rattrapage';
        } elseif ($MG_N !== null && $MG_N < 10 && $MG_R !== null && $MG_R > 10) {
            $etat = 'Valider après rattrapage';
        } elseif ($MG_N !== null && $MG_N < 10 && $MG_R !== null && $MG_R < 10) {
            $etat = 'Non valide';
        } elseif ($MG_N === null && $MG_R === null) {
            $etat = 'Absence';
        } else {
            $etat = '';
        }
        
        return [
            $row->id,
            $row->nom,
            $row->prenom,
            $row->CNE,
            $row->CNI,
            $row->CF_N,
            $row->TP_N,
            $row->MG_N,
            $row->CF_R,
            $row->MG_R,
            $etat
        ];
    }

}
