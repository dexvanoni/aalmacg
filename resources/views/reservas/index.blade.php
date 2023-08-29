@extends('layouts.padrao')

@section('titulo')
ALSS - Reservas
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
            <p class="alert alert-success">{{ Session::get('desativar') }}</p>
        @endif

        @if(Session::has('notificacao'))
            <p class="alert alert-danger">{{ Session::get('notificacao') }}</p>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Reservas</div>

                <div class="card-body">
                    <table class="table" id="lista_reservas">
                        <thead>
                            <tr>
                                <th>SÓCIO</th>
                                <th>Dt. Evento</th>
                                <th>Local</th>
                                <th>Celular</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reservas as $s)
                                <tr>
                                    <td>{{$s->socio}}</td>
                                    <td>{{$s->dt_evento}}</td>
                                    <td>{{$s->local}}</td>
                                    <td>{{$s->contato}}</td>
                                    <td>
                                        @if ($s->status == 'A')
                                            <center>
                                                <center><i class="fas fa-history"></i></center>
                                                <label style=" display: none;">AGUARDANDO</label>
                                            @elseif ($s->status == 'C')
                                            <center>
                                                <i style="color: green" class="fas fa-handshake"></i></center>
                                                <label style=" display: none;">APROVADO</label>
                                            @else
                                            <center>
                                                <i title="{{$s->obs}}" style="color: red" class="fas fa-times-circle"></i></center>
                                                <label style=" display: none;">NEGADO</label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($s->status == 'A')
                                           <a style="margin-right: 5px" title="ATENDER" href="{{route('atender', $s->id)}}">
                                            <i style="color: green" class="fas fa-book-reader"></i>
                                           </a>
                                        @endif
                                        <a title="DESATIVAR RESERVA" href="{{route('reserva.desativar', ['id' => $s->id]) }}">
                                           <i style="color: red" class="fab fa-expeditedssl"></i>
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
          $('#lista_reservas').DataTable({
            "order": [[ 4, "asc" ]],
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
