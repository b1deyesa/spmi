<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;

class ProgramStudiController extends Controller
{
    public function index()
    {
        $programStudi = ProgramStudi::all();

        return response()->json([
            'success' => true,
            'message' => 'List Program Studi',
            'data' => $programStudi
        ]);
    }
}
