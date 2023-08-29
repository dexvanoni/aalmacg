@extends('layouts.padrao')

@section('titulo')
ALSS - Notificação do Sócio {{$notificacao->socios_notificacao->id}}
@endsection

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Notificação do Sócio {{$notificacao->socios_notificacao->posto_grad}} {{$notificacao->socios_notificacao->nome_guerra}}</div>

                <div class="card-body">

					<form method="POST" action="{{ route('notificacao.update',['id' => $notificacao->id]) }}">
					          @csrf
					          @method('PUT')

					          <input type="hidden" name="id" value="{{$notificacao->id}}">

                        <!--PRIMEIRA LINHA-->
                        <div class="row">
                            <div class="col-5">
                                <label>SÓCIO</label>
                                <?php $socio = DB::table('socios')->where('id', $notificacao->socio_id)->first(); ?>
                                <input type="text" class="form-control" value="{{$socio->posto_grad}} {{$socio->nome_guerra}}" readonly="readonly">
                                <input type="hidden" name="socio_id" value="{{$notificacao->socio_id}}">
                            </div>
                            <div class="col-4">
                                <label>Notificação ao</label>
                                <select name="referente" class="form-control" required >
                                    <option value="{{$socio->posto_grad}} {{$socio->nome_guerra}}" {{ $notificacao->referente ==  $socio->posto_grad.' '.$socio->nome_guerra ? 'selected' : '' }}>{{$socio->posto_grad}} {{$socio->nome_guerra}}</option>

                                    @foreach ($notificacao->socios_notificacao->dependentes as $deps)
                                        <option value="{{$deps->nome_completo}}" {{ $notificacao->referente ==  $deps->nome_completo ? 'selected' : '' }}>{{$deps->nome_completo}}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="col-3">
                            	{{$notificacao->nivel}}
                                <label>Nível</label>
                                <select name="nivel" class="form-control" required >
                                        <option value="1" {{($notificacao->nivel === '1') ? 'Selected' : ''}} >1 - Baixo</option>
                                        <option value="2" {{($notificacao->nivel === '2') ? 'Selected' : ''}} >2 - Médio</option>
                                        <option value="3" {{($notificacao->nivel === '3') ? 'Selected' : ''}} >3 - Alto</option>
                                </select>
                            </div>
                        </div>
                        <p></p>
                        <!--SEGUNDA LINHA-->
                        <div class="row">
                            <div class="col-12">
                                NOTIFICAÇÃO
                                <textarea class="form-control" name="notificacao" rows="10">{{$notificacao->notificacao}}</textarea>
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

