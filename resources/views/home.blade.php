@php
    $dt = Carbon\Carbon::now();
    $dt->tz = new DateTimeZone('America/Campo_Grande');
    $dt->tz = 'America/Campo_Grande';
@endphp
@extends('layouts.padrao')

@section('titulo')
ALSS - Dashboard
@endsection

@section('content')
<div class="container">
  @if(Session::has('reserva'))
            <p class="alert alert-success">{{ Session::get('reserva') }}</p>
        @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!--primeira linha-->
                    <div class="row">

                    <!--EVENTOS-->
                    <div class="col-4">
                                @php
                                    $hoje = Carbon\Carbon::now();
                                    $hj = date('d/m/Y', strtotime($hoje));
                                    $data = $hoje->format('d/m/Y');
                                    $eventos = DB::table('eventos')->where('dt_evento', $data)->get();
                                @endphp
                        <div class="card" style="height: 201px">
                            <div class="card-header">
                                Eventos de hoje <span class="badge bg-secondary">{{$eventos->count()}}</span>
                            </div>
                            <div class="card-body scrollable" >
                              @if ($eventos->count() > 0)
                                 <table class="table" style="font-size: 11px">
                                   <thead>
                                       <tr>
                                           <th style="padding-right: 30px">Eventos</th>
                                           <th>Org.</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                    @foreach ($eventos as $ev)
                                       <tr>
                                              <td>{{$ev->nome}}</td>
                                              <td>{{$ev->resp}}</td>
                                       </tr>
                                    @endforeach
                                   </tbody>
                               </table> 
                               
                               @else
                                <h6>Não existe EVENTO para hoje!</h6>
                              @endif
                            
                            </div>
                        </div>
                    </div>

                    <!--RESERVAS-->
                    <div class="col-4">
                                @php
                                    $reservas = DB::table('reservas')->where('dt_evento', $data)->where('status', 'C')->get();
                                @endphp
                        <div class="card" style="height: 201px">
                            <div class="card-header">
                                Reservas de hoje <span class="badge bg-secondary">{{$reservas->count()}}</span>
                            </div>
                            <div class="card-body scrollable">
                              @if ($reservas->count() > 0)
                                 <table class="table" style="font-size: 11px" >
                                   <thead>
                                       <tr>
                                           <th>Sócio</th>
                                           <th>Local</th>
                                           <th>Piscina</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                      @foreach ($reservas as $re)
                                       <tr>
                                              <td>{{$re->socio}}</td>
                                              <td>{{$re->local}}</td>
                                              <td>
                                                @if($re->piscina == 'S')
                                                  <center><i style="color: green" class="fas fa-thumbs-up"></i></center>
                                                  @else
                                                  <center><i style="color: red" class="fas fa-times-circle"></i></center>
                                                @endif
                                              </td>
                                       </tr>
                                      @endforeach
                                   </tbody>
                               </table> 
                               
                               @else
                                <h6>Não existe RESERVA para hoje!</h6>
                              @endif
                            
                            </div>
                        </div>
                    </div>

                    <!--RESERVAS GERENCIAMENTO-->
                    <div class="col-4">
                                @php
                                    $reservas_ag = DB::table('reservas')->where('status', 'A')->get();
                                @endphp
                        <div class="card" style="height: 201px">
                            <div class="card-header">
                                Reservas para liberar <span class="badge bg-secondary">{{$reservas_ag->count()}}</span>
                            </div>
                            <div class="card-body scrollable">
                              @if ($reservas_ag->count() > 0)
                                 <table class="table" style="font-size: 11px" >
                                   <thead>
                                       <tr>
                                           <th>#</th>
                                           <th>Sócio</th>
                                           <th>Act.</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                    @foreach ($reservas_ag as $re_ag)
                                    <?php $d = DateTime::createFromFormat('d/m/Y', $re_ag->dt_evento)->format("Y-m-d"); ?>
                                       <tr style="background-color: @if($d < $hoje) #ffb3b3 @endif">
                                              <td>{{$re_ag->id}}</td>
                                              <td>{{$re_ag->socio}}</td>
                                              <td><a style="margin-right: 5px" title="ATENDER" href="{{route('atender', $re_ag->id)}}">
                                            <i style="color: green" class="fas fa-book-reader"></i>
                                           </a></td>
                                       </tr>
                                       @endforeach
                                   </tbody>
                               </table> 
                               
                               @else
                                <h6>Não existe RESERVA para liberação</h6>
                              @endif
                            
                            </div>
                        </div>
                    </div>

                  </div> <!--fecha primeira linha-->
<hr>
                  <!--SEGUNDA LINHA-->
                   <div class="row">
                     <!--VALORES-->
                    <div class="col-3">
                                @php
                                    $convites = DB::table('convites')->where('pg', 'S')->whereDate('created_at', $data)->get();
                                @endphp
                        <div class="card" style="height: 201px">
                            <div class="card-header">
                                Convites Distribuidos <span class="badge bg-secondary">{{$convites->count()}}</span><br> <label style="font-size: 11px">TOTAL RECEBIDO: R$ {{$convites->sum('valor')}}</label>
                            </div>
                            <div class="card-body scrollable">
                              @if ($convites->count() > 0)
                                 <table class="table" style="font-size: 11px" >
                                   <thead>
                                       <tr>
                                           <th>#</th>
                                           <th>N. Mesa</th>
                                           <th>N. Cadeira</th>
                                           <th>Valor</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                    @foreach ($convites as $c)
                                       <tr>
                                              <td>{{$c->id}}</td>
                                              <td>{{$c->num_mesa}}</td>
                                              <td>{{$c->num_cadeira}}</td>
                                              <td>{{$c->valor}}</td>
                                       </tr>
                                       @endforeach
                                   </tbody>
                               </table> 
                               
                               @else
                                <h6>Não existe CONVITE para Distribuição</h6>
                              @endif
                            
                            </div>
                        </div>
                    </div>
                    
                    <!--consulta disponibilidade-->
                    <div class="col-5">
                                @php
                                    $convites = DB::table('convites')->where('pg', 'S')->whereDate('created_at', $data)->get();
                                @endphp
                        <div class="card" style="height: 201px">
                            <div class="card-header">
                                Consulta Disponibilidade para Reserva
                                @isset ($dt_pesq)
                                     - Data pesquisada: {{date('d/m/Y', strtotime($dt_pesq))}}
                                @endisset
                            </div>
                            <div class="card-body scrollable">
                              <form action="{{route('disp')}}" method="POST">
                                 @csrf
                                 <div class="row">
                                   <div class="col">
                                     <input type="date" class="form-control" id="data" placeholder="Data pretendida" name="data">
                                   </div>
                                   <div class="col">
                                     <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-search"></i></button>
                                   </div>
                                 </div>
                              </form>
                            <div class="row">
                              <div class="col">
                                @isset ($vg)
                                    @if (count($vg) > 0)
                                  <table class="table" style="font-size: 11px">
                                  <thead>
                                    <tr>
                                      <th>Local Disponível</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($vg as $v)
                                      <tr>
                                        <td>{{$v}}</td>
                                      </tr>
                                    @endforeach
                                      </tbody>
                                    </table>
                                  @else
                                    <h6 style="color: red">LOTADO!</h6>
                                  @endif
                                @endisset
                              </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                      <?php $piscina = DB::table('piscinas')->whereDate('created_at', today())->get();?>
                          <div class="card" style="height: 201px">
                            <div class="card-header">
                                Pessoas utilizando a piscina <span class="badge bg-secondary">{{$piscina->count()}}</span>
                            </div>
                            <div class="card-body scrollable">
                              <ul>
                                @foreach($piscina as $pp)
                                  <?php 
                                    $soc_banhista = DB::table('socios')->where('carteira', $pp->carteira_id)->get();
                                    $dep_banhista = DB::table('dependentes')->where('carteira', $pp->carteira_id)->get();
                                  ?>
                                  @foreach($soc_banhista as $soc)
                                    <li>{{$soc->nome_completo}}</li>
                                  @endforeach
                                  @foreach($dep_banhista as $dep)
                                    <li>{{$dep->nome_completo}}</li>
                                  @endforeach
                                @endforeach
                              </ul>
                            </div>
                        </div>
                    </div>
                   </div><!--FECHA SEGUNDA LINHA-->

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
