@extends('layouts.padrao')

@section('titulo')
ALSS - Dependentes
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
                <div class="card-header">Lista de Dependentes</div>

                <div class="card-body">
                    <table class="table" id="lista_dependentes">
                        <thead>
                            <tr>
                                <th></th>
                                <th>SARAM</th>
                                <th>Sócio</th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dependentes as $s)
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
                                    <td>{{$s->socio->saram}}</td>
                                    <td>
                                       {{$s->socio->posto_grad}} {{$s->socio->nome_guerra}}
                                    </td>
                                    <td>{{$s->nome_completo}}</td>
                                    <td>
                                        @if ($s->socio->status == 'A')
                                            <center>
                                                <i title="Status do SÓCIO" style="color: green" class="fas fa-user-check"></i></center>
                                                <label style=" display: none;">Ativo</label>
                                            @else
                                            <center>
                                                <i title="Status do SÓCIO" style="color: red" class="fas fa-user-slash"></i></center>
                                                <label style=" display: none;">Inativo</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#"><i class="fab fa-searchengin" data-container="body" data-toggle="popover" data-html="true" data-placement="left" data-content="{{'Data de Inscrição: '.date('d/m/Y', strtotime($s->dt_inscricao))}}<br>{{'Sexo: '.$s->sexo}}<br>{{'Data de Nascimento: '. $s->dt_nasc}}<br>{{'Email: '.$s->email}}<br>{{'Endereço: '.$s->rua.', '.$s->num_casa.' - '.$s->complemento.' - '.$s->bairro}}<br>{{'Contato do Sócio: '.$s->socio->celular}}"></i></a>
                                       <a style="margin-right: 5px" title="EDITAR" href="{{route('dependente.edit', $s->id)}}">
                                        <i style="color: blue" class="fas fa-user-edit"></i>
                                       </a>
                                       <!--<a style="margin-right: 5px" title="EXCLUIR" href="{{route('dependente.destroy', $s->id)}}">
                                        <i style="color: red" class="fas fa-user-times"></i>
                                       </a>-->
                                       <a title="IMPRIMIR CARTEIRINHA" href="{{route('dependente.show', $s->id)}}">
                                        <i style="color: green" class="fas fa-address-card"></i>
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
          $('#lista_dependentes').DataTable({
            "order": [[ 5, "desc" ]],
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Dependentes ALSS',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Dependentes ALSS',
                exportOptions: {
                    columns: [ 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom: '\n\n\n\n\n\nRelação de Dependentes ALSS',
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