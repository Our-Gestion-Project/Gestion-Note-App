<?php

namespace App\Http\Controllers;

use App\Exports\NotesExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportingDataController extends Controller
{

    public function exporter_note($module_name)
    {
        $file_name = 'notes_module_' . $module_name . '_.csv';
        return Excel::download(new NotesExport(), $file_name);
    }
}
