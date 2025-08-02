<?php

namespace App\Http\Controllers\Dashboard\PenetapanPelaksanaan\StandarNasionalPendidikanTinggi\Fakultas;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\FakultasProfil;
use Illuminate\Http\Request;

class ProfilFakultasController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas', [
            'fakultas' => $fakultas
        ]);
    }
    
    public function update(Fakultas $fakultas, Request $request)
    {
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            FakultasProfil::find($key)->update([
                'value' => $value
            ]);
        }
        
        return redirect()->route('dashboard.penetapan-pelaksanaan.standar-nasional-pendidikan-tinggi.fakultas.profil-fakultas', ['fakultas' => $fakultas]);
    }
}
