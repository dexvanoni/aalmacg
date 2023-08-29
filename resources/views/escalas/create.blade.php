@extends('layouts.padrao')

@section('titulo')
ALSS - Nova Escala de Serviço
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        	Ultimos 3 escalados:
        	        <table class="table" id="escala_corrente">
                        <thead>
                            <tr>
                                <th>DATA</th>
                                <th>COR</th>
                                <th>MILITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($escala_corrente as $s)
                                <tr>
                                    <td>
                                       {{date('d/m/Y', strtotime($s->data_sv))}} -
                                       <?php
                                       		$data_serv = Carbon\Carbon::create($s->data_sv);
                                       		$dia = $data_serv->dayName;
                                       		echo $dia;
                                       ?>
                                    </td>
                                    <td>
                                    	@if($s->cor_sv == 'P')
                                    		<i style="color: black; width: 15px; height: 15px" class="fas fa-circle" ></i>
                                    	@elseif($s->cor_sv == 'V')
                                    		<i style="color: red; width: 15px; height: 15px" class="fas fa-circle" ></i>
                                    	@elseif($s->cor_sv == 'R')
                                    		<i style="color: purple; width: 15px; height: 15px" class="fas fa-circle" ></i>
                                    	@endif
                                    </td>
                                    <td>
                                       {{$s->posto_grad}} {{$s->nome_guerra}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

            <div class="card">
                <div class="card-header">Nova Escala</div>

                <div class="card-body">

                	<form action="{{ route('escala.store') }}" method="POST" enctype="multipart/form-data">
                		@csrf
                		<div id="origem"> <!-- INÍCIO DA LINHA DE ORIGEM-->
                		<div class="row">
                			<div class="col">
                				<select name="nome_guerra[]" class="form-control">
                					<option value="">Nome de Guerra</option>
                					@foreach ($militares as $m)
                						<option value="{{$m->nome_guerra}}">{{$m->nome_guerra}}</option>
                					@endforeach
                				</select>
                			</div>

                			<div class="col-3">
                				<input type="date" class="form-control" placeholder="Dia do Serviço" aria-label="Dia do Serviço" name="data_sv[]" required >
                			</div>

                			<div class="col-2">
                				<select name="cor_sv[]" class="form-control">
                					<option value="">ESCALA</option>
                					<option value="P" style="color: black" selected="selected">PRETA</option>
                					<option value="V" style="background-color: rgb(255, 0, 0)">VERMELHA</option>
                					<option value="R" style="color: rgb(153, 0, 255)">ROXA</option>
                				</select>
                			</div>

                			<div class="col-1">
                				 <button type="button" class="btn btn-primary" onclick="duplicarCampos()">+</button>
                			</div>
                		</div>
                		<p></p>
                	</div><!-- FIM DA LINHA DE ORIGEM-->

                		<div id="destino"><!--NOVAS DATAS INSERIDAS-->

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
				<script type="text/javascript">
        			var contagem = 0;

				    function duplicarCampos(){
				    var clone = document.getElementById('origem').cloneNode(true);
				    var destino = document.getElementById('destino');
				    destino.appendChild (clone);

				    var camposClonados = clone.getElementsByTagName('input');

				    	for(i=0; i<camposClonados.length;i++){
				        	camposClonados[i].value = '';
				    	}
					}
			</script>
@endsection

