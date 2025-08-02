<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\Fakultas;
use App\Models\Jenjang;
use App\Models\ProgramStudi;
use Illuminate\Http\Request;

class ProgramStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.program-studi.index', [
            'program_studis' => ProgramStudi::orderBy('fakultas_id')->orderBy('jenjang_id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.program-studi.create', [
            'fakultases' => Fakultas::pluck('nama', 'id')->toJson(),
            'jenjangs' => Jenjang::all()->mapWithKeys(fn($i) => [$i->id => "$i->gelar ($i->inisial)"])->toJson()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fakultas_id' => 'required',
            'jenjang_id' => 'required',
            'nama' => 'required',
            'tanggal_didirikan' => 'required',
        ]);
        
        ProgramStudi::create([
            'fakultas_id' => $request->fakultas_id,
            'jenjang_id' => $request->jenjang_id,
            'nama' => $request->nama,
            'tanggal_didirikan' => $request->tanggal_didirikan,
            'tanggal_ditutup' => $request->tanggal_ditutup,
        ]);
        
        return redirect()->route('setting.program-studi.index')->with('success','Berhasil menambahkan program studi');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramStudi $programStudi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProgramStudi $programStudi)
    {
        return view('setting.program-studi.edit', [
            'fakultases' => Fakultas::pluck('nama', 'id')->toJson(),
            'jenjangs' => Jenjang::all()->mapWithKeys(fn($i) => [$i->id => "$i->gelar ($i->inisial)"])->toJson(),
            'program_studi' => $programStudi
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProgramStudi $programStudi)
    {
        $request->validate([
            'fakultas_id' => 'required',
            'jenjang_id' => 'required',
            'nama' => 'required',
            'tanggal_didirikan' => 'required',
        ]);
        
        $programStudi->update([
            'fakultas_id' => $request->fakultas_id,
            'jenjang_id' => $request->jenjang_id,
            'nama' => $request->nama,
            'tanggal_didirikan' => $request->tanggal_didirikan,
            'tanggal_ditutup' => $request->tanggal_ditutup,
        ]);
        
        return redirect()->route('setting.program-studi.index')->with('success','Berhasil mengubah data program studi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();
        
        return redirect()->route('setting.program-studi.index')->with('Berhasil menghapus program studi');
    }
}
