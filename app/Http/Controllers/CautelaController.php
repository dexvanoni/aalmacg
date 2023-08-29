<?php

namespace App\Http\Controllers;

use App\Cautela;
use Illuminate\Http\Request;

class CautelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cautelas = Cautela::all();
        return view('cautelas.index', compact('cautelas'));
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
     * @param  \App\Cautela  $cautela
     * @return \Illuminate\Http\Response
     */
    public function show(Cautela $cautela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cautela  $cautela
     * @return \Illuminate\Http\Response
     */
    public function edit(Cautela $cautela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cautela  $cautela
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cautela $cautela)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cautela  $cautela
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cautela $cautela)
    {
        //
    }
}
