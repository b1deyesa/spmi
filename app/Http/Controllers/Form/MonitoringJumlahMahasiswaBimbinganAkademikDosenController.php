<?php

namespace App\Http\Controllers\Form;

use App\Models\Fakultas;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MonitoringJumlahMahasiswaBimbinganAkademikDosenController extends Controller
{
    public function index(Fakultas $fakultas, ProgramStudi $programStudi)
    {
        return view('form.monitoring-jumlah-mahasiswa-bimbingan-akademik-dosen', [
            'program_studis' => $fakultas->programStudis()->get(),
            'program_studi' => $programStudi
        ]);
    }
}
