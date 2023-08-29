@extends('layouts.padrao')
<?php
date_default_timezone_set('America/Campo_Grande');
setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
$dt = Carbon\Carbon::now();
?>
<?php
    								$hoje = Carbon\Carbon::now();
    								$amanha = $hoje->addDays(1);
    								$ontem = $hoje->subDays(1);

                                	$email_dir = Auth::user()->email;
                                	$diretor = DB::table('diretores')->where('email', $email_dir)->first();
                                	//dd($diretor);
                                	//exit;
                                ?>
@section('titulo')
ALSS - Escalas
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
<!--MODAL DE QUADRINHOS-->

<div class="modal fade" id="quadrinhos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Quadrinhos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <table class="table" id="quadrinho">
                        <thead>
                            <tr>
                                <th style="width: 30%">MILITAR</th>
                                <th style="width: 70%">QUADRINHOS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quadrinhos->unique('nome_guerra') as $q)
                                <tr>
                                    <td>
                                       {{$q->posto_grad}} {{$q->nome_guerra}}
                                    </td>
                                    <td style="width: 70%">
                                    <?php
                                    	$pr = DB::table('escalas')
                                    		->where('nome_guerra', $q->nome_guerra)
                                    		->where('cor_sv', 'P')
                                    		->get();
                                    	$vr = DB::table('escalas')
                                    		->where('nome_guerra', $q->nome_guerra)
                                    		->where('cor_sv', 'V')
                                    		->get();
                                    	$rx = DB::table('escalas')
                                    		->where('nome_guerra', $q->nome_guerra)
                                    		->where('cor_sv', 'R')
                                    		->get();
                                   ?>
                                   	@foreach($pr as $p)
                                   		<i title=" <?php echo date("d/m/Y", strtotime($p->data_sv)); ?>" width="5px" style="color: black; border: solid white" class="fas fa-square"></i>
                                   	@endforeach
                                   	@foreach($vr as $v)
                                   		<i title=" <?php echo date("d/m/Y", strtotime($v->data_sv)); ?>" width="5px" style="color: red; border: solid white" class="fas fa-square"></i>
                                   	@endforeach
                                   	@foreach($rx as $r)
                                   		<i title=" <?php echo date("d/m/Y", strtotime($r->data_sv)); ?>" width="5px" style="color: purple; border: solid white" class="fas fa-square"></i>
                                   	@endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!--FECHA MODAL DE QUADRINHOS-->

<!--MODAL DE ESTATÍSTICAS-->

<div class="modal fade" id="estatisticas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Estatísticas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         <table class="table" id="estatistica">
                        <thead>
                            <tr>
                                <th style="width: 30%">MILITAR</th>
                                <th>PRETAS</th>
                                <th>VERMELHAS</th>
                                <th>ROXAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quadrinhos->unique('nome_guerra') as $e)
                            <?php
                                    	$pretas = DB::table('escalas')
                                    		->where('nome_guerra', $e->nome_guerra)
                                    		->where('cor_sv', 'P')
                                    		->count();
                                    	$vermelhas = DB::table('escalas')
                                    		->where('nome_guerra', $e->nome_guerra)
                                    		->where('cor_sv', 'V')
                                    		->count();
                                    	$roxas = DB::table('escalas')
                                    		->where('nome_guerra', $e->nome_guerra)
                                    		->where('cor_sv', 'R')
                                    		->count();
                                   ?>
                                <tr>
                                    <td>
                                       {{$e->posto_grad}} {{$e->nome_guerra}}
                                    </td>
                                    <td>
                                    	{{$pretas}}
                                    </td>
                                    <td>
                                    	{{$vermelhas}}
                                    </td>
                                    <td>
                                    	{{$roxas}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<!--FECHA MODAL DE ESTATÍSTICAS-->

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
                <div class="card-header">Escala do mês de {{$dt->isoFormat('MMMM YYYY')}}</div>

                <div class="card-body">
                	@if($diretor->funcao == 'PRESIDÊNCIA' || $diretor->funcao == 'ESCALA')
                		<a class="btn btn-success" href="{{route('escala.create')}}">NOVA ESCALA</a>
                	@endif
                		<a class="btn btn-danger" data-toggle="modal" data-target="#quadrinhos" href="#">QUADRINHOS</a>
                		<a class="btn btn-warning" data-toggle="modal" data-target="#estatisticas" href="#">ESTATÍSTICAS</a>
                		<hr>
                    <table class="table" id="escala_corrente">
                        <thead>
                            <tr>
                                <th>DATA</th>
                                <th>COR</th>
                                <th>MILITAR</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($escala_corrente as $s)
                            <?php
                                $data_serv = Carbon\Carbon::create($s->data_sv);
                                $dia = $data_serv->dayName;
                            ?>
                                <tr>
                                    <td>
                                       {{date('d/m/Y', strtotime($s->data_sv))}} - {{ $dia }}
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
                                    <td>
                                    @if($s->data_sv > $hoje)
                                    @if($diretor->funcao == 'PRESIDÊNCIA' || $diretor->funcao == 'ESCALA')

	                                       <a style="margin-right: 5px" title="TROCA" href="{{route('escala.edit', $s->id)}}">
	                                        <i class="fas fa-users-cog"></i>
	                                       </a>

                                    @endif
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
            var texto1 = '________________________________________________';
            var texto2 = "Escalante da ALSS";
          $('#escala_corrente').DataTable({
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nEscala ALSS ',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nEscala ALSS',
                exportOptions: {
                    columns: [ 0, 2]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom:  '\n\n\n\n\n\n'+texto1+'\n'+texto2,

                pageSize: 'A4',
                exportOptions: {
                    columns: [ 0, 2]
                }
            },
                'colvis',
            ],
              "scrollY":        "300px",
                "scrollCollapse": true,
          });

           $('#quadrinho').DataTable({
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nEscala ALSS ',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nEscala ALSS',
                exportOptions: {
                    columns: [ 0, 2]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom: '\n\n\n\n\n\n'+texto1+'\n'+texto2,

                pageSize: 'A4',
                exportOptions: {
                    columns: [ 0, 2]
                }
            },
                'colvis',
            ],
              "scrollY":        "300px",
                "scrollCollapse": true,
          });

                      $('#estatistica').DataTable({
            dom: 'Bfrtip',
                    buttons: [
            {
                extend: 'copyHtml5',
                messageBottom: '\n\n\n\n\n\nEstatística de Escala ALSS ',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'excelHtml5',
                messageBottom: '\n\n\n\n\n\nEstatística de Escala ALSS',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'pdfHtml5',
                messageBottom: '\n\n\n\n\n\nEstatística de Escala ALSS',

                pageSize: 'A4',
                exportOptions: {
                    columns: [0, 1, 2, 3]
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
