@extends('layouts.padrao')

@section('titulo')
ALSS - Atendimento de Reserva
@endsection

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Atendimento de Reserva do Sócio {{$reserva->socio}}</div>

                <div class="card-body">

                    <form action="{{ route('atender_reserva', $reserva->id) }}" method="POST">
                        @csrf

                        <!--PRIMEIRA LINHA-->
                        <div class="row">
                            <div class="col-3">
                                <label style="color: blue">Local:</label> {{$reserva->local}}
                            </div>
                            <div class="col-4">
                                <label style="color: blue">Sócio:</label> {{$reserva->socio}}
                            </div>
                            <div class="col-2">
                                <label style="color: blue">Tipo:</label> {{$reserva->tipo}}
                            </div>
                            <div class="col-3">
                                <label style="color: blue">Data do Evento:</label> {{$reserva->dt_evento}}
                            </div>
                        </div>

                        <p></p>

                        <div class="row">
                            <div class="col-2">
                                <label style="color: blue">Período:</label> {{$reserva->periodo}}
                            </div>
                            <div class="col-4">
                                <label style="color: blue">Consumo de Alcool:</label> <?php if($reserva->alcool == 'S'){echo "SIM";}else{echo "NÃO";}?>
                            </div>
                            <div class="col-3">
                                <label style="color: blue">Piscina:</label> <?php if($reserva->piscina == 'S'){echo "SIM";}else{echo "NÃO";}?>
                            </div>
                            <div class="col-3">
                                <label style="color: blue">Campos/Quadras: </label> <?php if($reserva->campos_quadras_parques == 'S'){echo "SIM";}else{echo "NÃO";}?>
                            </div>
                        </div>

                        <p></p>

                        <div class="row">
                            <div class="col">
                                <label style="color: blue">Contato:</label> {{$reserva->contato}}
                            </div>
                        </div>

                        <hr>

                        <div style="border: solid orange; padding: 10px">
                            <div class="row">
                                <div class="col">
                                    <label style="color: red">Pago</label>
                                    <select name="pago" class="form-control">
                                        <option selected="selected">Selecione...</option>
                                        <option value="S">SIM</option>
                                        <option value="N">NÃO</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label style="color: red">Status</label>
                                    <select name="status" class="form-control">
                                        <option selected="selected">Selecione...</option>
                                        <option value="C">APROVAR</option>
                                        <option value="N">NEGAR</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label style="color: red">Valor Pago</label>
                                    <input type="text" name="valor_pago" class="form-control" placeholder="R$">
                                </div>
                            </div>
                            <p></p>
                            <div class="row">
                                <div class="col">
                                <label style="color: red">Observações</label>
                                    <textarea class="form-control" name="obs"></textarea>
                                </div>
                            </div>
                        </div>
                                <input type="hidden" name="id" value="{{$reserva->id}}">                        
                                <input type="hidden" name="socio" value="{{$reserva->socio}}">
                                <input type="hidden" name="tipo" value="{{$reserva->tipo}}">
                                <input type="hidden" name="local" value="{{$reserva->local}}">
                                <input type="hidden" name="dt_evento" value="{{$reserva->dt_evento}}">
                                <input type="hidden" name="periodo" value="{{$reserva->periodo}}">
                                <input type="hidden" name="alcool" value="{{$reserva->alcool}}">
                                <input type="hidden" name="piscina" value="{{$reserva->piscina}}">
                                <input type="hidden" name="campos_quadras_parques" value="{{$reserva->campos_quadras_parques}}">
                                <input type="hidden" name="contato" value="{{$reserva->contato}}">
                                  <input type="hidden" name="diretor" value="{{Auth::user()->name}}">
                                  <input type="hidden" name="id_socio" value="{{$reserva->id_socio}}">

                        <div class="row">
                            <div class="col" style="margin-top: 30px">
                                <button type="submit" class="btn btn-success">ENVIAR</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

