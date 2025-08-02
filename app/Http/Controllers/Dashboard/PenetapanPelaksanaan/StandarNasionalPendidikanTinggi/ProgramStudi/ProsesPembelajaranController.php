<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\ProgramStudi;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class ProsesPembelajaranController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.program-studi.proses-pembelajaran');
    }
}
