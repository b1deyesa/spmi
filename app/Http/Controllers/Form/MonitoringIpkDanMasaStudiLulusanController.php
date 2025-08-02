<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class MonitoringIpkDanMasaStudiLulusanController extends Controller
{
    public function index(Fakultas $fakultas, ProgramStudi $programStudi)
    {
        return view('form.monitoring-ipk-dan-masa-studi-lulusan', [
            'program_studis' => $fakultas->programStudis()->get(),
            'program_studi' => $programStudi
        ]);
    }
}
