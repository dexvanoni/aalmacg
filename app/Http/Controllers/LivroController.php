<?php

namespace App\Http\Controllers;

use App\Livro;
use Illuminate\Http\Request;
use App\Diretor;
use App\Convite;
use App\Dependente;
use App\Socio;
use App\Escala;
use App\Evento;
use App\Piscina;
use App\Reserva;
use App\Notificacao;
use App\Cautela;
use Carbon;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::all();
        return view('livros.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $diretores = Diretor::all();
        $convites = Convite::all();
        $dependentes = Dependente::all();
        $socios = Socio::all();
        $escalas = Escala::all();
        $eventos = Evento::all();
        $piscinas = Piscina::all();
        $reservas = Reserva::all();
        $notificacoes = Notificacao::all();
        $livros = Livro::all();

        return view('livros.create', compact('diretores', 'convites', 'dependentes', 'socios', 'escalas', 'eventos', 'piscinas', 'reservas', 'notificacoes', 'livros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        exit;
    }
/**
     * Display the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        $livros = Livro::find($livro);

        $diretores = Diretor::all();
        $convites = Convite::all();
        $dependentes = Dependente::all();
        $socios = Socio::all();
        $escalas = Escala::all();
        $eventos = Evento::all();
        $piscinas = Piscina::all();
        $reservas = Reserva::all();
        $notificacoes = Notificacao::all();
        $cautelas = Cautela::all();
        $livros = Livro::all();

        return view('livros.show', compact('cautelas', 'diretores', 'convites', 'dependentes', 'socios', 'escalas', 'eventos', 'piscinas', 'reservas', 'notificacoes', 'livros'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function edit(Livro $livro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Livro  $livro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        //
    }
}
