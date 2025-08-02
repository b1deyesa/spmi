<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Fakultas $fakultas)
    {
        return view('form.index', [
            'fakultas' => $fakultas
        ]);
    }
}
