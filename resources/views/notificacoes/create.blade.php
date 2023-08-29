@extends('layouts.padrao')

@section('titulo')
ALSS - Nova Notificação Sócio
@endsection

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Nova Notificação do Sócio {{$socio->posto_grad}} {{$socio->nome_guerra}}</div>

                <div class="card-body">

                    <form action="{{ route('notificacao.store') }}" method="POST">
                        @csrf

                        <!--PRIMEIRA LINHA-->
                        <div class="row">
                            <div class="col-5">
                                <label>SÓCIO</label>
                                <input type="text" class="form-control" value="{{$socio->posto_grad}} {{$socio->nome_guerra}}" readonly="readonly">
                                <input type="hidden" name="socio_id" value="{{$socio->id}}">
                            </div>
                            <div class="col-4">
                                <label>Notificação ao</label>
                                <select name="referente" class="form-control" required >
                                    <option selected="selected">Selecione...</option>
                                    <option value="{{$socio->posto_grad}} {{$socio->nome_guerra}}">{{$socio->posto_grad}} {{$socio->nome_guerra}}</option>
                                    @foreach ($socio->dependentes as $deps)
                                        <option value="{{$deps->nome_completo}}">{{$deps->nome_completo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                <label>Nível</label>
                                <select name="nivel" class="form-control" required >
                                        <option selected="selected">Selecione...</option>
                                        <option value="1">1 - Baixo</option>
                                        <option value="2">2 - Médio</option>
                                        <option value="3">3 - Alto</option>
                                </select>
                            </div>
                        </div>
                        <p></p>
                        <!--SEGUNDA LINHA-->
                        <div class="row">
                            <div class="col-12">
                                NOTIFICAÇÃO
                                <textarea class="form-control" name="notificacao" rows="10"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <p></p>
                                <button style="margin-top: 10px" type="submit" class="btn btn-success">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

