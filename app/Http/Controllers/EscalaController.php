<?php

namespace App\Http\Controllers;

use App\Escala;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;
use DateTime;
use App\Diretor;

    date_default_timezone_set('America/Campo_Grande');
    setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
    setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
    // Create Carbon date

class EscalaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dt = Carbon::now();
        $mes_corrente = $dt->month;
        $escala_corrente = DB::table('escalas')->whereMonth('data_sv', $mes_corrente)->orderBy('data_sv')->get();
        $quadrinhos = DB::table('escalas')->get();

        $preta = collect(DB::table('escalas')
                    ->select(DB::raw('count(*) as pretas, nome_guerra, data_sv'))
                     ->where('cor_sv', 'P')
                     ->groupBy('nome_guerra', 'data_sv')
                     ->get());

        $vermelha = collect(DB::table('escalas')
                    ->select(DB::raw('count(*) as vermelhas, nome_guerra, data_sv'))
                     ->where('cor_sv', 'V')
                     ->groupBy('nome_guerra', 'data_sv')
                     ->get());

        $roxa = collect(DB::table('escalas')
                    ->select(DB::raw('count(*) as roxas, nome_guerra, data_sv'))
                     ->where('cor_sv', 'R')
                     ->groupBy('nome_guerra', 'data_sv')
                     ->get());

        return view('escalas.index', compact('escala_corrente', 'quadrinhos', 'preta', 'vermelha', 'roxa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $dt = Carbon::now();
        $mes_corrente = $dt->month;
        $escala_corrente = DB::table('escalas')->whereMonth('data_sv', $mes_corrente)->orderBy('data_sv', 'desc')->take(3)->get();
        $quadrinhos = DB::table('escalas')->get();

        $preta = collect(DB::table('escalas')
                    ->select(DB::raw('count(*) as pretas, nome_guerra, data_sv'))
                     ->where('cor_sv', 'P')
                     ->groupBy('nome_guerra', 'data_sv')
                     ->get());

        $vermelha = collect(DB::table('escalas')
                    ->select(DB::raw('count(*) as vermelhas, nome_guerra, data_sv'))
                     ->where('cor_sv', 'V')
                     ->groupBy('nome_guerra', 'data_sv')
                     ->get());

        $roxa = collect(DB::table('escalas')
                    ->select(DB::raw('count(*) as roxas, nome_guerra, data_sv'))
                     ->where('cor_sv', 'R')
                     ->groupBy('nome_guerra', 'data_sv')
                     ->get());

        $militares = DB::table('diretores')->where('status', 'A')->get();
        return view('escalas.create', compact('militares', 'escala_corrente', 'quadrinhos', 'preta', 'vermelha', 'roxa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mats = $request->all();

            for ($i=0; $i < count($mats['nome_guerra']); $i++) {
            $posto = DB::table('diretores')->where('nome_guerra', $mats['nome_guerra'][$i])->get();
            $arrayForm = array(
             //'posto_grad' => $mats['posto_grad'][$i],
             'posto_grad' => $posto[0]->posto_grad,
             'nome_guerra' => $mats['nome_guerra'][$i],
             'data_sv' => $mats['data_sv'][$i],
             'cor_sv' => $mats['cor_sv'][$i],
            );
            $mat = Escala::create($arrayForm);
        }

        return redirect()->action('EscalaController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function show(Escala $escala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function edit(Escala $escala)
    {
        $trocar = $escala;
        return view('escalas.edit', compact('trocar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $trocar)
    {

        DB::table('escalas')
            ->where('id', $trocar)
            ->update(['posto_grad' => $request->posto_grad,
                      'nome_guerra' => $request->nome_guerra]);
        return redirect()->action('EscalaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Escala  $escala
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escala $escala)
    {
        //
    }
}
