<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class PengaturanKebijakanSpmiController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('dashboard.penetapan-pelaksanaan.pengaturan-kebijakan-spmi', [
            'fakultas' => $fakultas
        ]);
    }
}
