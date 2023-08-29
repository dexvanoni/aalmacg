<?php

namespace App\Http\Controllers;

use App\Dependente;
use App\Socio;
use Illuminate\Http\Request;
use Canducci\ZipCode\Facades\ZipCode;
use Carbon\Carbon;
use DB;
use Session;
use DateTime;

class DependenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $dependentes = Dependente::all();
        return view('dependentes.index', compact('dependentes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function new_dep($id) {
         $socio = Socio::find($id);
         return view('dependentes.create', compact('socio'));
    }

    public function create()
    {
       // substituído pela função acima!
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
            $dt->tz = new \DateTimeZone('America/Campo_Grande');
            $dt->tz = 'America/Campo_Grande';
         // Handle File Upload
        if($request->hasFile('foto')){
            // Get filename with the extension
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            // Get just filename
            //$filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $filename = 'dependente_'.$request->socio_id;
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
        $saram = DB::table('socios')->where('id', $request->socio_id)->first();

        $dependentes = Dependente::create([
            'socio_id' => $request->socio_id,
            'foto' => $fileNameToStore,
            'nome_completo' => $request->nome_completo, 
            'sexo' => mb_strtolower($request->sexo),
            'dt_nasc' => DateTime::createFromFormat('d/m/Y', $request->dt_nasc)->format("Y-m-d"),
            'email' => $request->email,
            'celular' => $request->celular,
            'rua' => $request->rua,
            'cep' => $request->cep,
            'num_casa' => $request->num_casa,
            'bairro' => $request->bairro, 
            'complemento' => $request->complemento,
            'pin' => $request->pin,
            'dt_inscricao' => $dt,
        ]);
                //cria o número da carteira com o SARAM e o seu próprio ID
        $carteira = $saram->saram.$dependentes->id;
        DB::table('dependentes')->where('id', $dependentes->id)->update(['carteira' => $carteira]);
        $request->session()->flash(
            'mensagem',
            "Dependente {$dependentes->id} inserid@ com sucesso: {$dependentes->nome_completo}"
        );
        return  redirect()->route('dependente.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dependente = Dependente::find($id);
        if ($dependente->status == 'I') {
            Session::flash('inativo', 'O sócio encontra-se INATIVO neste sistema!');
            return  redirect()->route('socio.index');
        }
        return view('dependentes.show', compact('dependente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function edit(Dependente $dependente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependente $dependente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependente  $dependente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependente $dependente)
    {
        //
    }
}
