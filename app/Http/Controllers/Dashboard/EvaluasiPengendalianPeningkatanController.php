<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class EvaluasiPengendalianPeningkatanController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('dashboard.evaluasi-pengendalian-peningkatan');
    }
}
