<?php

namespace App\Http\Controllers;

use App\Diretor;
use Illuminate\Http\Request;
use DB;
use Auth;

class DiretorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $diretores = DB::table('diretores')->orderBy('nome_completo')->get();
        return view('diretores.index', compact('diretores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diretores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $diretores = Diretor::create([
            'saram' => $request->saram,
            'nome_completo' => $request->nome_completo,
            'nome_guerra' => $request->nome_guerra,
            'status' => $request->status,
            'posto_grad' => $request->posto_grad,
            'funcao' => $request->funcao,
            'saram' => $request->saram,
            'local_trab' => $request->local_trab,
            'contato' => $request->contato,
            'email' => $request->email,
        ]);
        $request->session()->flash(
            'diretor',
            "Diretor registrado!"
        );
        return  redirect()->route('diretor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Diretor  $diretor
     * @return \Illuminate\Http\Response
     */
    public function show(Diretor $diretor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Diretor  $diretor
     * @return \Illuminate\Http\Response
     */
    public function edit(Diretor $diretor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Diretor  $diretor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diretor $diretor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Diretor  $diretor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diretor $diretor)
    {
        //
    }
}
