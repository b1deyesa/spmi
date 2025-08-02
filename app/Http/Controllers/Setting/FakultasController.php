<?php

namespace App\Http\Controllers\Setting;

use App\Models\Fakultas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting.fakultas.index', [
            'fakultases' => Fakultas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'inisial' => 'required|unique:fakultas,inisial',
            'tanggal_didirikan' => 'required'
        ]);
        
        Fakultas::create([
            'nama' => $request->nama,
            'inisial' => Str::upper($request->inisial),
            'tanggal_didirikan' => $request->tanggal_didirikan
        ]);
        
        return redirect()->route('setting.fakultas.index')->with('success','Berhasil menambahkan fakultas');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fakultas $fakulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fakultas $fakulta)
    {
        return view('setting.fakultas.edit', [
            'fakultas' => $fakulta
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fakultas $fakulta)
    {
        $request->validate([
            'nama' => 'required',
            'inisial' => 'required|unique:fakultas,inisial,'. $fakulta->id,
            'tanggal_didirikan' => 'required'
        ]);
        
        $fakulta->update([
            'nama' => $request->nama,
            'inisial' => $request->inisial,
            'tanggal_didirikan' => $request->tanggal_didirikan,
            'tanggal_ditutup' => $request->tanggal_ditutup
        ]);
        
        return redirect()->route('setting.fakultas.index')->with('success', 'Berhasil mengubah data fakultas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fakultas $fakulta)
    {
        $fakulta->delete();
        
        return redirect()->route('setting.fakultas.index')->with('success','Berhasil menghapus fakultas');
    }
}
