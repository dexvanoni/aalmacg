<?php

namespace App\Http\Controllers;

use App\Piscina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Session;
use Auth;
use Carbon\Carbon;
use DateTimeZone;
use DateTime;

class PiscinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $piscinas = Piscina::all();
        return view('piscinas.index', compact('piscinas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('piscinas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $piscinas = Piscina::create([
            'carteira_id' => $request->carteira_id,
            'num_pulseira' => $request->num_pulseira,
            'convidado' => $request->convidado,
            'obs' => $request->obs, 
        ]);
        $request->session()->flash(
            'piscina',
            "Entrada registrada!"
        );
        return  redirect()->route('piscina.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function show(Piscina $piscina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function edit(Piscina $piscina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Piscina $piscina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Piscina  $piscina
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piscina $piscina)
    {
        //
    }

    public function pesquisa(Request $request){

        $soc = DB::table('socios')->where('carteira', $request->carteira)->first();
        $dep = DB::table('dependentes')->where('carteira', $request->carteira)->first();        

            if ($soc) {
                $notificacoes = DB::table('notificacaos')->where('socio_id', $soc->id)->get();
                Session::put('soc', 'S');
                return view('piscinas.create', compact('soc', 'notificacoes'));
            } elseif ($dep) {
                Session::put('dep', 'S');
                return view('piscinas.create', compact('dep'));
            } else {
                Session::flash('mensagem', 'Sócio/Dependente não encontrado!');
                return  view('piscinas.create');        
            }
    }

}
