@extends('layouts.padrao')

@section('titulo')
ALSS - Cautelas
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

        @if(Session::has('mensagem'))
            <p class="alert alert-success">{{ Session::get('mensagem') }}</p>
        @endif

        @if(Session::has('desativar'))
            <p class="alert alert-danger">{{ Session::get('desativar') }}</p>
        @endif

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cautelas</div>

                <div class="card-body">
                    <table class="table" id="lista_dependentes">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Carteira</th>
                                <th>Material</th>
                                <th>Status</th>
                                <th>Condição</th>
                                <th>Diretor</th>
                                <th>Obs.</th>
                                <th>Retirada</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cautelas as $s)
                            @php
                                $nome = App\Socio::where('carteira', $s->carteira)->get();
                            @endphp
                                <tr>
                                    <td>
                                        {{ $s->id }}
                                    </td>
                                    <td title="{{ $nome[0]->posto_grad }} {{ $nome[0]->nome_guerra }}">
                                        {{$s->carteira}}
                                    </td>
                                    <td>
                                       {{$s->material}}
                                    </td>
                                    <td>
                                        {{$s->status}}
                                    </td>
                                    <td>
                                        {{ $s->condicao }}
                                    </td>
                                    <td>{{ $s->diretor }}</td>
                                    <td>{{ $s->obs }}</td>
                                    <td>{{ date('d/m/Y', strtotime($s->created_at)) }}</td>
                                    <td>
                                       <a style="margin-right: 5px" title="EDITAR" href="{{route('cautela.edit', $s->id)}}">
                                        <i style="color: blue" class="fas fa-edit"></i>
                                       </a>
                                       <a style="margin-right: 5px" title="EXCLUIR" href="{{route('cautela.destroy', $s->id)}}">
                                        <i style="color: red" class="fas fa-ban"></i>
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
    @php
        $dta = Carbon\Carbon::now()->locale('pt_BR');
        // Force locale
        date_default_timezone_set('America/Campo_Grande');
        setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
        setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');

    @endphp
@endsection
@section('datatables')
    <script>
        var dtta = "{{ $dta->format('d/m/Y H:i:s') }}";
        var quem = "{{ Auth::user()->name }}";
        $(document).ready(function() {
          $('#lista_dependentes').DataTable({
            "order": [[ 5, "desc" ]],
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Reservas Esportivas da ALSS',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Reservas Esportivas da ALSS'+dtta,
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Reservas Esportivas da ALSS gerada em '+dtta+' por '+quem,
                orientation: 'landscape',
                pageSize: 'A4',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9 ]
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
