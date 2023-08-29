@extends('layouts.padrao')

@section('titulo')
ALSS - Notificações
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

        @if(Session::has('ativar'))
            <p class="alert alert-success">{{ Session::get('ativar') }}</p>
        @endif

        @if(Session::has('desativar'))
            <p class="alert alert-danger">{{ Session::get('desativar') }}</p>
        @endif

        @if(Session::has('notificacao'))
            <p class="alert alert-danger">{{ Session::get('notificacao') }}</p>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Sócios</div>

                <div class="card-body">
                    <table class="table" id="lista_socios">
                        <thead>
                            <tr>
                                <th>Sócio</th>
                                <th>Referente a</th>
                                <th>Nível</th>
                                <th>Notificação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notificacoes as $s)
                                <tr>
                                    <td>
                                    	{{$s->socios_notificacao->posto_grad}} {{$s->socios_notificacao->nome_guerra}}
                                    </td>
                                    <td>
                                    	{{$s->referente}}
                                    </td>
                                    <td>
                                       @if($s->nivel == '1')
                                        		<i style="color: green" class="fas fa-exclamation-circle"> BAIXO</i>
                                        	@elseif($s->nivel == '2')
                                        		<i style="color: orange" class="fas fa-radiation-alt"> MÉDIO</i>
                                        	@else
                                        		<i style="color: red" class="fas fa-skull-crossbones"> ALTO</i>
                                        @endif
                                    </td>
                                    <td><center><a href="#"><i class="fab fa-searchengin" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{$s->notificacao}}"></i>
                                        </a></center></td>
                                    <td>
	                                    <a style="margin-right: 5px" title="EDITAR NOTIFICAÇÃO" href="{{route('notificacao.edit', $s->id)}}">
	                                        <i style="color: blue" class="fas fa-user-edit"></i>
	                                     </a>
                                       
                                       <a style="margin-right: 5px" title="DESATIVAR NOTIFICAÇÃO" href="{{route('notificacao.desativar', $s->id)}}">
                                        <i style="color: red" class="fas fa-user-times"></i>
                                       </a>

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
          $('#lista_socios').DataTable({
            "order": [[ 5, "desc" ]],
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Sócios ALSS',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Sócios ALSS',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Sócios ALSS',
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6 ]
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