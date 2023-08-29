<?php

namespace App\Http\Controllers;

use App\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Session;
use Auth;
use Carbon\Carbon;
use DateTimeZone;
use DateTime;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservas = Reserva::all();
        return view('reservas.index', compact('reservas'));
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
        $reservas = Reserva::create([
            'socio' => $request->socio,
            'id_socio' => $request->id_socio,
            'tipo' => $request->tipo,
            'local' => $request->local,
            'dt_evento' => $request->dt_evento,
            'periodo' => $request->periodo,
            'alcool' => $request->alcool,
            'piscina' => $request->piscina,
            'campos_quadras_parques' => $request->campos_quadras_parques,
            'contato' => $request->contato,
            'status' => 'A',
            'diretor' => $request->diretor,
            'pago' => $request->pago,
            'valor_pago' => $request->valor_pago,
            'obs' => $request->obs,
        ]);

        if (Auth::check()) {
            $request->session()->flash('reserva', "Reserva para o Sr. {$reservas->socio} foi realizada com sucesso! ");
            return redirect()->route('home');
        }

        Session::flush();
        if ($request->local == 'Toca dos Patos') {
            $val = 'R$ 30,00';
        } elseif ($request->local == 'Toca dos Gansos') {
            $val = 'R$ 30,00';
        } elseif ($request->local == 'Tiburcio') {
            $val = 'R$ 30,00';
        } elseif ($request->local == 'Caverna') {
            $val = 'R$ 50,00';
        } else {
            echo 'Selecione!';
        }
        $mss = "Sua PRÉ-RESERVA na $request->local foi efetuada com sucesso! Para confirmá-la, efetue o pagamento da taxa de $val e envie o comprovante para o Whatsapp (67) 99122-4547. Clique no botão abaixo para verificar os meios de pagamento.";
        $request->session()->flash('reserva', $mss);
        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }

    public function disp(Request $request)
    {
        $espacos = DB::table('espacos')
            ->where('status', 'A')
            ->get();

        $vagas = DB::table('reservas')
            ->where('dt_evento', date('d/m/Y', strtotime($request->data)))
            ->get();

        $existente = DB::table('reservas')
            ->where('dt_evento', date('d/m/Y', strtotime($request->data)))
            ->where('status', 'C')
            ->get();

        foreach ($espacos as $e) {
            if (!$existente->contains('local', $e->nome)) {
                $vg[] = $e->nome;
            }
        }

        $dt_pesq = $request->data;
        return view('home', compact('vagas', 'vg', 'dt_pesq'));
    }

    public function disp2(Request $request)
    {
        if (Session::has('saram')) {
            $saram = Session::get('saram');

            $dt = Carbon::now();
            $dt->tz = new DateTimeZone('America/Campo_Grande');
            $dt->tz = 'America/Campo_Grande';

            $socio = DB::table('socios')
                ->where('saram', $saram)
                ->first();

            //reservas aguardando autorização (status A)
            $reservas_a = DB::table('reservas')
                ->where('id_socio', $saram)
                ->where('status', 'A')
                ->orderBy('dt_evento')
                ->get();

            //reservas concluídas/autorizadas ou não, que estejam agendadas para data posterior a de hoje(status C)
            $reservas_c = DB::table('reservas')
                ->where('id_socio', $saram)
                ->where('status', 'C')
                ->orderBy('dt_evento')
                ->get();

            //reservas NÃO autorizadas que estejam agendadas para data posterior a de hoje(status N)
            $reservas_n = DB::table('reservas')
                ->where('id_socio', $saram)
                ->where('status', 'N')
                ->orderBy('dt_evento')
                ->get();
        }

        //-------------------------------------------------------------------------------------------------------------------------
        $espacos = DB::table('espacos')
            ->where('status', 'A')
            ->get();

        $vagas = DB::table('reservas')
            ->where('dt_evento', date('d/m/Y', strtotime($request->data)))
            ->get();

        //qualquer status de agendamento não aparecer na relação de espaços disponíveis
        $existente = DB::table('reservas')
            ->where('dt_evento', date('d/m/Y', strtotime($request->data)))
            //->where('status', 'C')
            ->get();

        foreach ($espacos as $e) {
            if (!$existente->contains('local', $e->nome)) {
                $vg[] = $e->nome;
            }
        }

        Session::put('vagas', 'vagas');
        $dt_pesq = $request->data;
        return view('reservas.create', compact('vagas', 'vg', 'dt_pesq', 'reservas_a', 'reservas_c', 'reservas_n'));
    }

    public function login_socio()
    {
        if (Auth::check()) {
            Session::put('diretor', 'diretor');
            return view('reservas.create', compact('socio'));
        } else {
            return view('reservas.login_socio');
        }
    }

    public function login_socio_dados(Request $request)
    {
        $dt = Carbon::now();
        $dt->tz = new DateTimeZone('America/Campo_Grande');
        $dt->tz = 'America/Campo_Grande';

        $socio = DB::table('socios')
            ->where('saram', $request->saram)
            ->first();

        //reservas aguardando autorização (status A)
        $reservas_a = DB::table('reservas')
            ->where('id_socio', $socio->saram)
            ->where('status', 'A')
            ->orderBy('dt_evento')
            ->get();

        //reservas concluídas/autorizadas ou não, que estejam agendadas para data posterior a de hoje(status C)
        $reservas_c = DB::table('reservas')
            ->where('id_socio', $socio->saram)
            ->where('status', 'C')
            ->orderBy('dt_evento')
            ->get();

        //reservas NÃO autorizadas que estejam agendadas para data posterior a de hoje(status N)
        $reservas_n = DB::table('reservas')
            ->where('id_socio', $socio->saram)
            ->where('status', 'N')
            ->orderBy('dt_evento')
            ->get();

        if ($socio->pin == $request->pin) {
            Session::put('socio', $socio->posto_grad . ' ' . $socio->nome_guerra);
            Session::put('socio_contato', $socio->celular);
            Session::put('saram', $socio->saram);
            if ($socio->status == 'I') {
                $request->session()->flash('nao_loga', 'USUÁRIO INATIVO. Favor dirigir-se ao Clube!');
                return redirect()->route('login_socio');
            } else {
                return view('reservas.create', compact('socio', 'reservas_a', 'reservas_c', 'reservas_n'));
            }
        } else {
            $request->session()->flash('nao_loga', 'SARAM ou PIN incorretos! Tente novamente.');
            return redirect()->route('login_socio');
        }
    }

    public function atender($id)
    {
        $reserva = Reserva::find($id);
        return view('reservas.atender', compact('reserva'));
    }

    public function atender_reserva(Request $request)
    {
        $reservas = Reserva::where('id', $request->id)->update([
            'socio' => $request->socio,
            'id_socio' => $request->id_socio,
            'tipo' => $request->tipo,
            'local' => $request->local,
            'dt_evento' => $request->dt_evento,
            'periodo' => $request->periodo,
            'alcool' => $request->alcool,
            'piscina' => $request->piscina,
            'campos_quadras_parques' => $request->campos_quadras_parques,
            'contato' => $request->contato,
            'status' => $request->status,
            'diretor' => $request->diretor,
            'pago' => $request->pago,
            'valor_pago' => $request->valor_pago,
            'obs' => $request->obs,
        ]);

        $request->session()->flash('reserva_atende', 'O atendimento da reserva foi realizada com sucesso! ');
        return redirect()->route('reserva.index');
    }

    public function desativar($id){

        $reservas = Reserva::find($id);

        DB::table('reservas')
            ->where('id', $reservas->id)
            ->update([
                'status' => 'N'
            ]);

        Session::flash('desativar', "A reserva para $reservas->local do dia $reservas->dt_evento foi DESATIVADO com sucesso!");
        return  redirect()->route('reserva.index');
        }
}
