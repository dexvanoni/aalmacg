@extends('layouts.padrao')

@section('titulo')
ALSS - TROCA DE SERVIÇO
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Troca de Serviço</div>

                <div class="card-body">

                	<form method="POST" action="{{ route('escala.update',$trocar->id) }}">
                    @csrf
                    @method('PUT')

                      <table class="table" id="troca">
                        <thead>
                            <tr>
                                <th>DATA DO SERVIÇO</th>
                                <th>MILITAR DE SERVIÇO</th>
                                <th>TROCAR POR</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>
                                       {{date('d/m/Y', strtotime($trocar->data_sv))}} -
                                       <?php 
                                            $data_serv = Carbon\Carbon::create($trocar->data_sv);
                                            $dia = $data_serv->dayName;
                                            echo $dia;
                                       ?>
                                       <input type="hidden" name="id" value="{{$trocar->id}}">
                                       <input type="hidden" name="data_sv" value="{{$trocar->data_sv}}">
                                       <input type="hidden" name="cor_sv" value="{{$trocar->cor_sv}}">
                                    </td>
                                    <td>
                                        {{$trocar->posto_grad}} {{$trocar->nome_guerra}}
                                    </td>
                                    <td>
                                        <div class="row">
                                            <div class="col-4">
                                                <select name="posto_grad" class="form-control">
                                                    <option value="">Posto/Grad</option>
                                                    <option value="1S">1S</option>
                                                    <option value="2S">2S</option>
                                                    <option value="3S">3S</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <select name="nome_guerra" class="form-control">
                                                    <?php $militares = DB::table('diretores')->where('status', 'A')->get(); ?>
                                                    <option value="">Nome de Guerra</option>
                                                    @foreach ($militares as $m)
                                                        <option value="{{$m->nome_guerra}}">{{$m->nome_guerra}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
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

