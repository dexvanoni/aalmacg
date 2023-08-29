<?php

namespace App\Http\Controllers;

use App\Carga;
use Illuminate\Http\Request;

class CargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cargas = Carga::all();
        return view('carga.index', compact('cargas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function show(Carga $carga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function edit(Carga $carga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carga $carga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carga  $carga
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carga $carga)
    {
        //
    }
}
