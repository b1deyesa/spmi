<?php

namespace App\Http\Controllers\Form;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonitoringSkorToeflLulusanController extends Controller
{
    public function index(Fakultas $fakultas, ProgramStudi $programStudi)
    {
        return view('form.monitoring-skor-toefl-lulusan', [
            'program_studis' => $fakultas->programStudis()->get(),
            'program_studi' => $programStudi
        ]);
    }
}
