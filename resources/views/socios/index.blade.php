@extends('layouts.padrao')

@section('titulo')
ALSS - Sócios
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
                                <th></th>
                                <th>SARAM</th>
                                <th>N. Guerra</th>
                                <th>Celular</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socios as $s)
                                <tr>
                                    <td>
                                        @if (!is_null($s->foto))
                                        <a class="foto">
                                            <img class="foto" src="/storage/foto/{{$s->foto}}">
                                            <span>
                                                <img src="/storage/foto/{{$s->foto}}" width="100px"  >
                                            </span>
                                        </a>
                                        @else
                                         <i class="fas fa-camera"></i>
                                        @endif
                                    </td>
                                    <td>{{$s->saram}}
                                        <?php
                                        $conta_not = DB::table('notificacaos')
                                                ->where('socio_id', $s->id)
                                                ->count();
                                            $conta_not_1 = DB::table('notificacaos')
                                                ->where('socio_id', $s->id)
                                                ->where('nivel', 1)
                                                ->count();
                                            $conta_not_2 = DB::table('notificacaos')
                                                ->where('socio_id', $s->id)
                                                ->where('nivel', 2)
                                                ->count();
                                            $conta_not_3 = DB::table('notificacaos')
                                                ->where('socio_id', $s->id)
                                                ->where('nivel', 3)
                                                ->count();
                                                /*$conta_not = $not->count();
                                            $conta_not_1 = $not->count('nivel', '=', 1);
                                            $conta_not_2 = $not->count('nivel', 2);
                                            $conta_not_3 = $not->count('nivel', 3);
                                            */

                                            //PARÂMETROS DE NOTIFICAÇÕES
                                                if ($conta_not_1 >= 2 && $conta_not_2 >= 1 && $conta_not_3 == 1 || $conta_not_3 >= 1 && $conta_not_3 <= 3) {
                                                    $notif = 1;
                                                } elseif ($conta_not_1 > 3 && $conta_not_2 >= 2 && $conta_not_3 >= 2 && $conta_not_3 <= 4) {
                                                    $notif = 2;
                                                } elseif ($conta_not_3 > 4 || $conta_not_2 > 5 || $conta_not_1 > 6) {
                                                    $notif = 3;
                                                } else {
                                                    $notif = 0;
                                                }
                                            // FECHA PARÂMETROS

                                           $getData = DB::table('notificacaos')
                                           ->where('socio_id', $s->id)
                                             ->select('nivel', DB::raw('count(*) as total'))
                                             ->groupBy('nivel')
                                             ->get();
                                        ?>

                                    </td>
                                    <td>
                                        @if ($notif == 0)
                                            <i class="fas fa-circle" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{'Notificações: '}}<br>{{ 'Nível 1 = '.$conta_not_1 }}<br>{{ 'Nível 2 = '.$conta_not_2 }}<br>{{ 'Nível 3 = '.$conta_not_3 }}<br>" style="color: green"></i>
                                        @elseif ($notif == 1)
                                            <i class="fas fa-circle" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{'Notificações: '}}<br>{{ 'Nível 1 = '.$conta_not_1 }}<br>{{ 'Nível 2 = '.$conta_not_2 }}<br>{{ 'Nível 3 = '.$conta_not_3 }}<br>"  style="color: rgb(255, 251, 0)"></i>
                                        @elseif ($notif == 2)
                                            <i class="fas fa-circle" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{'Notificações: '}}<br>{{ 'Nível 1 = '.$conta_not_1 }}<br>{{ 'Nível 2 = '.$conta_not_2 }}<br>{{ 'Nível 3 = '.$conta_not_3 }}<br>"  style="color: rgb(255, 17, 0)"></i>
                                        @elseif ($notif == 3)
                                            <i class="fas fa-circle" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{'Notificações: '}}<br>{{ 'Nível 1 = '.$conta_not_1 }}<br>{{ 'Nível 2 = '.$conta_not_2 }}<br>{{ 'Nível 3 = '.$conta_not_3 }}<br>"  style="color: rgb(30, 0, 78)"></i>
                                        @endif
                                       {{$s->posto_grad}} {{$s->nome_guerra}}
                                    </td>
                                    <td>{{$s->celular}}</td>
                                    <td>
                                        @if ($s->status == 'A')
                                            <center>
                                                <i style="color: green" class="fas fa-user-check"></i></center>
                                                <label style=" display: none;">Ativo</label>
                                            @else
                                            <center>
                                                <i style="color: red" class="fas fa-user-slash"></i></center>
                                                <label style=" display: none;">Inativo</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#"><i class="fab fa-searchengin" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{'Nome Completo: '.$s->nome_completo}}<br>{{'Data de Inscrição: '.date('d/m/Y', strtotime($s->dt_inscricao))}}<br>{{'Sexo: '.$s->sexo}}<br>{{'Data de Nascimento: '.$s->dt_nasc}}<br>{{'Email: '.$s->email}}<br>{{'Endereço: '.$s->rua.', '.$s->num_casa.' - '.$s->complemento.' - '.$s->bairro}}<br>{{'Nº de Dependentes: '.$s->num_deps}}<br>{{'Nº de Notificações: '.$conta_not}}"></i></a>
                                        @if ($s->status == 'A')
                                       <a style="margin-right: 5px" title="EDITAR" href="{{route('socio.edit', $s->id)}}">
                                        <i style="color: blue" class="fas fa-user-edit"></i>
                                       </a>
                                       @endif
                                       <!--<a style="margin-right: 5px" title="EXCLUIR" href="{{route('socio.destroy', $s->id)}}">
                                        <i style="color: red" class="fas fa-user-times"></i>
                                       </a>-->
                                       @if ($s->status == 'A')
                                       <a title="IMPRIMIR CARTEIRINHA" href="{{route('socio.show', $s->id)}}">
                                        <i style="color: green" class="fas fa-address-card"></i>
                                       </a>
                                       @endif
                                       @if ($s->status == 'A')
                                        <a title="DESATIVAR SÓCIO" href="{{route('socio.desativar', ['id' => $s->id]) }}">
                                           <i style="color: red" class="fab fa-expeditedssl"></i>
                                        </a>
                                        @else
                                        <a title="ATIVAR SÓCIO" href="{{route('socio.ativar', ['id' => $s->id]) }}">
                                           <i style="color: blue"  class="fas fa-hand-point-up"></i>
                                        </a>
                                       @endif
                                       @if ($s->status == 'A')
                                       <a title="ADD DEPENDENTES" href="{{route('dependente.new_dep', ['id' => $s->id]) }}">
                                           <i style="color: orange" class="fas fa-user-friends"></i>
                                        </a>
                                        @endif
                                        <a title="NOTIFICAÇÃO" href="{{route('notificacao.nova', ['id' => $s->id]) }}">
                                           <i style="color: black" class="fas fa-book-dead"></i>
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
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
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