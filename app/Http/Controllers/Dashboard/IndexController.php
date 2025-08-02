<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Fakultas; 
use App\Models\Jenjang; 
use App\Models\ProgramStudi;

class IndexController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        $fakultas = Fakultas::all(); 
        $program_studis = ProgramStudi::orderBy('fakultas_id')->get(); 
        $jenjang = Jenjang::all();
        
        return view('dashboard.index', compact(
            'fakultas',
            'program_studis',
            'jenjang'
        ));
    }
}
