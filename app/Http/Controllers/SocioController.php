<?php

namespace App\Http\Controllers;

use App\Socio;
use Illuminate\Http\Request;
use Canducci\ZipCode\Facades\ZipCode;
use Carbon\Carbon;
use DB;
use Session;

class SocioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socios = DB::table('socios')->orderBy('status')->get();
        return view('socios.index', compact('socios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('socios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $dt = Carbon::now();
            $dt_AA = Carbon::now()->format('Y-m-d');
            $dt->tz = new \DateTimeZone('America/Campo_Grande');
            $dt->tz = 'America/Campo_Grande';
         // Handle File Upload
        if($request->hasFile('foto')){
            // Get filename with the extension
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            // Get just filename
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = 'socio_'.$request->saram;
            // Get just ext
            $extension = $request->file('foto')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('foto')->storeAs('public/foto', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.png';
        }
        //save in database
        $socios = Socio::create([
            'saram' => $request->saram,
            'foto' => $fileNameToStore,
            'posto_grad' => $request->posto_grad,
            'nome_completo' => $request->nome_completo,
            'nome_guerra' => mb_strtolower($request->nome_guerra),
            'dt_inscricao' => $request->dt_inscricao,
            'sexo' => mb_strtolower($request->sexo),
            'dt_nasc' => $request->dt_nasc,
            'email' => $request->email,
            'celular' => $request->celular,
            'ramal' => $request->ramal,
            'local_trab' => mb_strtolower($request->local_trab),
            'rua' => $request->rua,
            'cep' => $request->cep,
            'num_casa' => $request->num_casa,
            'bairro' => $request->bairro,
            'complemento' => $request->complemento,
            'num_deps' => $request->num_deps,
            'pin' => $request->pin,
            'status' =>'A',
            'dt_inscricao' => $dt_AA,

        ]);
        $carteira = '1'.$request->saram.$socios->id;
        DB::table('socios')->where('id', $socios->id)->update(['carteira' => $carteira]);
        $request->session()->flash(
            'mensagem',
            "Sócio {$socios->id} inserid@ com sucesso {$socios->posto_grad} {$socios->nome_guerra}"
        );
        return  redirect()->route('socio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $socio = Socio::find($id);
        if ($socio->status == 'I') {
            Session::flash('inativo', 'Este sócio encontra-se INATIVO neste sistema!');
            return  redirect()->route('socio.index');
        }
        return view('socios.show', compact('socio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $socio = Socio::find($id);
        return view('socios.edit', compact('socio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Socio $socio)
    {
        echo $socio->id;
        exit;
        $socios = Socio::find($socio->id);
        $data = $request->all();

        $socios->fill($data)->save();

        return  redirect()->route('socio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Socio  $socio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Socio $socio)
    {
        //
    }

    public function ativar($id){

        $socio = Socio::find($id);

        DB::table('socios')
            ->where('id', $socio->id)
            ->update([
                'status' => 'A'
            ]);

        Session::flash('ativar', 'O sócio: '.$socio->posto_grad.' '.$socio->nome_guerra.' foi ATIVADO com sucesso!');
        return  redirect()->route('socio.index');
    }

    public function desativar($id){

        $socio = Socio::find($id);

        DB::table('socios')
            ->where('id', $socio->id)
            ->update([
                'status' => 'I'
            ]);

        Session::flash('desativar', 'O sócio: '.$socio->posto_grad.' '.$socio->nome_guerra.' foi DESATIVADO com sucesso!');
        return  redirect()->route('socio.index');
    }
}
