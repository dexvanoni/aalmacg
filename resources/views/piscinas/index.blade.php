@extends('layouts.padrao')

@section('titulo')
ALSS - Usuários das Piscinas
@endsection

@section('estilo')
<style type="text/css" media="screen">
            .foto {
                position: relative; /* Para que a imagem não saia fora do link */
                display: block;
                padding: 5px 0;
                color: #FFFFFF;
                  background-color: #ddd;
                  border-radius: 100%;
                  height: 30px;
                  object-fit: cover;
                  width: 30px;
            }
            .foto:hover {
                background-color: #999999;
            }
            .foto span {
                display: none; /* Aqui você define que todo SPAN que estiver dentro de um A estará invisível */
            }
            .foto:hover span {
                display: block; /* Tranforma o SPAN em um elemento do tipo bloco */
                position: absolute; /* Para você poder posicionar a vontade, sem quebrar o layour em volta */
                top: 0px; /* Para ficar na mesma altura do link */
                left: 100%; /* Empurra a imagem para fora do link, ficando a lado do mesmo */
                width: 50px;
                height: 30px;
            }

</style>
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">

        @if(Session::has('inativo'))
            <p class="alert alert-danger">{{ Session::get('inativo') }}</p>
        @endif

        @if(Session::has('reserva_atende'))
            <p class="alert alert-success">{{ Session::get('reserva_atende') }}</p>
        @endif

        @if(Session::has('desativar'))
            <p class="alert alert-danger">{{ Session::get('desativar') }}</p>
        @endif

        @if(Session::has('notificacao'))
            <p class="alert alert-danger">{{ Session::get('notificacao') }}</p>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de utilização das piscinas</div>

                <div class="card-body">
                    <table style="font-size: 12px" class="table" id="lista_piscinas">
                        <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Sócio - Contato</th>
                                <th>Data</th>
                                <th>Pulseira</th>
                                <th>Obs</th>
                                <th>Celular</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($piscinas as $s)
                            	<?php
                            		$nome_soc = DB::table('socios')->where('carteira', $s->carteira_id)->first();
                            		$nome_dep = DB::table('dependentes')->where('carteira', $s->carteira_id)->first();
                            	 ?>
                                <tr>
                                    <td>
                                    	@if(!is_null($nome_dep))
                                    		{{$nome_dep->nome_completo}}
                                    	@else
                                    		{{$nome_soc->nome_completo}}
                                    	@endif
                                    </td>
                                    <td>
                                        @if(!is_null($nome_dep))
                                            @php
                                                $soc = DB::table('socios')->where('id', $nome_dep->socio_id)->get();
                                                //dd($soc);
                                            @endphp
                                            {{ $soc[0]->posto_grad }} {{ $soc[0]->nome_guerra }} - {{ $soc[0]->celular }}
                                        @endif
                                    </td>
                                    <td>{{date('d/m/Y', strtotime($s->created_at))}}</td>
                                    <td>{{$s->num_pulseira}}</td>
                                    <td>{{$s->obs}}</td>
                                    <td>
                                       @if(!is_null($nome_dep))
                                    		{{$nome_dep->celular}}
                                    	@else
                                    		{{$nome_soc->celular}}
                                    	@endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
    </div>
	</div>
@endsection
@section('datatables')
    <script>
        $(document).ready(function() {
          $('#lista_piscinas').DataTable({
            "order": [[ 1, "desc" ]],
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Reservas ALSS',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Reservas ALSS',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, ]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Reservas ALSS',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5 ]
                }
            },
                'colvis',
            ],
              "scrollY":        "300px",
                "scrollCollapse": true,
          });
        } );
    </script>


@endsection

@section('js_head')
<script>
    function aumenta(obj){
        obj.height=obj.height*2;
        obj.width=obj.width*2;
    }
    function diminui(obj){
        obj.height=obj.height/2;
        obj.width=obj.width/2;
    }
    </script>
@endsection
