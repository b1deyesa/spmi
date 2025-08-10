<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class StandarYangDitetapkanInstitusiController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('dashboard.penetapan-pelaksanaan.standar-yang-ditetapkan-institusi', [
            'fakultas' => $fakultas
        ]);
    }
}
