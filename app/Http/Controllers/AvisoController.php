<?php

namespace App\Http\Controllers;

use App\Aviso;
use Illuminate\Http\Request;

class AvisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $avisos = Aviso::all();
        return view('avisos.index', compact('avisos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('avisos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $avisos = Aviso::create([
            'nome_guerra' => $request->nome_guerra,
            'status' => $request->status,
            'validade' => $request->validade,
            'aviso' => $request->aviso,
        ]);
        $request->session()->flash(
            'avisos',
            "Aviso registrado!"
        );
        return  redirect()->route('aviso.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function show(Aviso $aviso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function edit(Aviso $aviso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviso $aviso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aviso  $aviso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aviso $aviso)
    {
        //
    }
}
