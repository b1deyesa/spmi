<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class AkreditasiController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.akreditasi', [
            'fakultas' => $fakultas
        ]);
    }
}
