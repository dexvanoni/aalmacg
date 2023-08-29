<?php

namespace App\Http\Controllers;

use App\Notificacao;
use Illuminate\Http\Request;
use App\Socio;
use DB;
use Auth;

class NotificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificacoes = Notificacao::all();
        return view('notificacoes.index', compact('notificacoes'));
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
        $notificacoes = Notificacao::create([
            'socio_id' => $request->socio_id,
            'referente' => $request->referente,
            'notificacao' => $request->notificacao,
            'nivel' => $request->nivel,
        ]);
        $request->session()->flash(
            'notificacao',
            "O Sócio foi notificado com nível {$notificacoes->nivel}"
        );
        return  redirect()->route('socio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notificacao  $notificacao
     * @return \Illuminate\Http\Response
     */
    public function show(Notificacao $notificacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notificacao  $notificacao
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notificacao = Notificacao::find($id);
        return view('notificacoes.edit', compact('notificacao'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notificacao  $notificacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Notificacao::where('id', $request->id)
          ->update([
                    'socio_id' => $request->socio_id,
                    'referente' => $request->referente,
                    'notificacao' => $request->notificacao,
                    'nivel' => $request->nivel,
                    ]);

          $request->session()->flash(
            'notificacao',
            "Notificação alterada com sucesso!"
        );
        return  redirect()->route('notificacao.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notificacao  $notificacao
     * @return \Illuminate\Http\Response
     */

    public function destroy(){

    }

    public function desativar($id)
    {
        if (Auth::user()->email == 'teste@fab.mil.br'){

            $notificacao = Notificacao::find($id);
            $notificacao->delete();
            session()->flash(
                'notificacao',
                "NOTIFICAÇÃO EXCLUÍDA COM SUCESSO!"
            );
            return  redirect()->route('notificacao.index');

        }else{
            session()->flash(
                'notificacao',
                "Somente o PRESITENTE DA ALSS tem permissão para EXCLUIR uma notificação!"
            );
            return  redirect()->route('notificacao.index');
        }
    }

    public function nova($id)
    {
        $socio = Socio::find($id);
        return view('notificacoes.create', compact('socio'));
    }
}
