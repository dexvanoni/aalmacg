@php
    $dt = Carbon\Carbon::now();
	$dt->tz = new DateTimeZone('America/Campo_Grande');
    $dt->tz = 'America/Campo_Grande';
@endphp
<!DOCTYPE html>
<html>
<head>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RESERVA DE ESPAÇO ALSS</title>
	 <!-- Bootstrap CSS -->

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="/bootstrap/sidebar/style4.css">


    <!-- Font Awesome JS -->

    <script src="https://kit.fontawesome.com/275566dc00.js" crossorigin="anonymous"></script>

    <!--DATATABLES-->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

    @yield('estilo')

    <style type="text/css" media="screen">
      body {
       background-color: #cccccc;
      }

      .card{
         background-color: #cccccc;
      }
        .scrollable{
          overflow-y: auto;
          max-height: 150px;
        }
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

    <script type="text/javascript">
      function futuras() {
    var x = document.getElementById('reservas_futuras');
    if (x.style.display == 'none') {
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
}
    </script>

	@yield('js_head')

</head>
<body>
	 <div class="wrapper">
        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg" style="background-color: #cccccc">
                <div class="container-fluid">
                  @if(Session::get('saram'))
                    <a class="navbar-brand" href="#"><i class="fas fa-umbrella-beach"></i> {{Session::get('socio')}}</a>
                    @else
                    <a class="navbar-brand" href="#">Diretor: {{Auth::user()->name}}</a>
                  @endif
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                           <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" style="padding-right: 4.5rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    SAIR <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

<!-- BLOCO DE EDIÇÃO -->
            <div class="container">
              @if(Session::get('saram'))
              <div class="row">
                <span class="badge badge-pill badge-primary" onclick="futuras()">Clique aqui para ver suas reservas FUTURAS</span>
              </div>
              @endif
              <div id="reservas_futuras" STYLE="display:none">
              @if(Session::get('saram'))
                <div class="row">
                  <div class="col">
                    <table class="table">
                      <thead>
                        <tr>
                        <th style="width: 10%">Dt Evento</th>
                        <th style="width: 20%">Local</th>
                        <th style="width: 5%">Status</th>
                        <th>Obs</th>
                      </tr>
                      </thead>
                      <tbody>
                        @isset($reservas_a)
                          @foreach($reservas_a as $a)
                          <tr>
                            <?php
                              $dt_ev_a = DateTime::createFromFormat('d/m/Y', $a->dt_evento)->format('Y-m-d');
                            ?>
                              @if ($dt_ev_a >= $dt->format('Y-m-d'))
                                <td>{{$a->dt_evento}}</td>
                                <td>{{$a->local}}</td>
                                <td><center><i class="fas fa-history"></i></center></td>
                                <td>{{$a->obs}}</td>
                              @endif
                          </tr>
                          @endforeach
                        @endisset

                        @isset($reservas_c)
                        @foreach($reservas_c as $c)
                        <tr>
                          <?php
                            $dt_ev_c = DateTime::createFromFormat('d/m/Y', $c->dt_evento)->format('Y-m-d');
                          ?>
                            @if ($dt_ev_c >= $dt->format('Y-m-d'))
                              <td>{{$c->dt_evento}}</td>
                              <td>{{$c->local}}</td>
                              <td><center><i style="color: green" class="fas fa-handshake"></i></center></td>
                              <td>{{$c->obs}}</td>
                            @endif
                        </tr>
                        @endforeach
                        @endisset

                        @isset($reservas_n)
                          @foreach($reservas_n as $n)
                          <tr>
                            <?php
                              $dt_ev_n = DateTime::createFromFormat('d/m/Y', $n->dt_evento)->format('Y-m-d');
                            ?>
                              @if ($dt_ev_n >= $dt->format('Y-m-d'))
                                <td>{{$n->dt_evento}}</td>
                                <td>{{$n->local}}</td>
                                <td><center><i style="color: red" class="fas fa-times-circle"></i></center></td>
                                <td>{{$n->obs}}</td>
                              @endif
                          </tr>
                          @endforeach
                        @endisset
                      </tbody>

                    </table>
                  </div>
                </div>

                @endif

              </div>

                <hr>
                      <div class="card" id="pesquisa">
                            <div class="card-header">
                                <span class="badge badge-pill badge-danger">1º PASSO</span> Consulta Disponibilidade para Reserva <br>

                            </div>
                            <div class="card-body">
                              <form action="{{route('disp2')}}" method="POST">
                                 @csrf
                                 <div class="row">
                                   <div class="col">
                                     <input type="date" class="form-control" id="data" placeholder="Data pretendida" name="data">
                                     <small id="passwordHelpBlock" class="form-text text-muted">
                                      @isset ($dt_pesq)
                                        Pesquisa realizada: {{date('d/m/Y', strtotime($dt_pesq))}}
                                      @endisset
                                     </small>
                                   </div>
                                   <div class="col">
                                     <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-search"></i></button>
                                   </div>
                                 </div>
                              </form>
                            </div>
                        </div>
<p></p>
                <div class="card" id="reserva">
                    <div class="card-header"><span class="badge badge-pill badge-danger">2º PASSO</span> Preencha TODOS os campos para sua Reserva</div>
                    <div class="car-body">
                        <div class="container">
                    <form action="{{ route('reserva.store') }}" method="POST">
                        @csrf

                        <!--PRIMEIRA LINHA-->
                        <div class="row">
                            <div class="col-5">
                                <label>Selecione o local</label>
                                <select class="form-control" name="local" required>
                                    <option disabled="disabled" selected="selected">Selecione</option>}
                                    @isset ($vg)
                                        @if (count($vg) > 0)
                                            @foreach ($vg as $v)
                                                <option value="{{$v}}"><?php
                                                    if ($v == "Toca dos Patos") {
                                                        echo "Toca dos Patos - Taxa: R$ 30,00";
                                                    } elseif ($v == "Toca dos Gansos") {
                                                        echo "Toca dos Gansos - Taxa: R$ 30,00";
                                                    } elseif ($v == "Tiburcio") {
                                                        echo "Tiburcio - Taxa: R$ 30,00";
                                                    } elseif ($v == "Caverna") {
                                                        echo "Caverna - Taxa: R$ 50,00";
                                                    } else {
                                                        echo "Selecione!";
                                                    }
                                                ?></option>
                                            @endforeach
                                        @endif
                                    @endisset
                                </select>
                            </div>
                            <div class="col-4">
                                <label>Sócio </label>
                                @if(Session::has('socio'))
                                  <span class="badge badge-pill badge-warning">Somente leitura</span>
                                @else
                                  <span class="badge badge-pill badge-warning">Filtro inteligente</span>
                                @endif
                                 @if(Session::has('socio'))
                                    <input type="text" class="form-control" value="{{ Session::get('socio') }}" name="socio" readonly="readonly">
                                    @else
                                    <?php $socios = DB::table('socios')->where('status', 'A')->get();?>

                                    <input class="form-control"  list="socios" name="socio">
                                    <datalist id="socios">
                                        @foreach($socios as $ss)
                                            <option value="{{$ss->posto_grad}} {{$ss->nome_guerra}}">{{$ss->posto_grad}} {{$ss->nome_guerra}}</option>
                                          @endforeach
                                      </datalist>
                                @endif
                            </div>
                            <div class="col-3">
                                <label>Tipo de evento</label>
                                <select class="form-control" name="tipo" required>
                                    <option value="Particular">Particular</option>
                                    <option value="Corporativo">Corporativo</option>
                                </select>
                            </div>
                        </div>
                        <p></p>
                        <div class="row">
                            <div class="col-3">
                                <label>Data do Evento</label><span class="badge badge-pill badge-warning">Somente leitura</span>
                                @isset ($dt_pesq)
                                    <input type="text" class="form-control" id="date" data-mask="00/00/0000" name="dt_evento" value="{{date('d/m/Y', strtotime($dt_pesq))}}" readonly="readonly" required >
                                @endisset
                            </div>
                            <div class="col-2">
                                <label>Período</label>
                                <select class="form-control" name="periodo" required>
                                    <option value="1/2 Período">1/2 Período</option>
                                    <option value="Integral">Integral</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label>Consumo de Alcool</label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="alcool" id="alcool_s" value="S">
                                  <label class="form-check-label" for="alcool_s">SIM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="alcool" id="alcool_n" value="N">
                                  <label class="form-check-label" for="alcool_n">NÃO</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <label>Piscina</label><br>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="piscina" id="piscina_s" value="S">
                                  <label class="form-check-label" for="piscina_s">SIM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="piscina" id="piscina_n" value="N">
                                  <label class="form-check-label" for="piscina_n">NÃO</label>
                                </div>
                            </div>
                            <div class="col-2">
                                <label>Campos/Quadras</label>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="campos_quadras_parques" id="campos_quadras_parques_s" value="S">
                                  <label class="form-check-label" for="campos_quadras_parques_s">SIM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="campos_quadras_parques" id="campos_quadras_parques_n" value="N">
                                  <label class="form-check-label" for="campos_quadras_parques_n">NÃO</label>
                                </div>
                            </div>
                        </div>
                        <P></P>

                                 @if(Session::has('socio_contato'))
                                    <input type="hidden" value="{{ Session::get('socio_contato') }}" readonly="readonly" name="contato">
                                    <input type="hidden" value="{{ Session::get('saram') }}" readonly="readonly" name="id_socio">
                                 @endif

                                 <input type="hidden" name="valor_pago" value="0">
                                 @if(Session::has('diretor'))
                                  <input type="hidden" name="diretor" value="{{Auth::user()->name}}">
                                  @else
                                  <input type="hidden" name="diretor" value="d">
                                 @endif
                                 <input type="hidden" name="pago" value="N">
                                 <input type="hidden" name="obs" value="">


                        @if(Session::has('diretor'))
                          <div class="row">
                              <div class="col-3">
                              <label>Contato</label>
                                 <input type="text" data-mask="(00) 00000-0000" class="form-control" id="contato" placeholder="Celular" aria-label="Celular" name="contato" required >
                              </div>
                              <div class="col-9">
                                <label>SARAM</label>
                                @if(Session::has('socio'))
                                  <span class="badge badge-pill badge-warning">Somente leitura</span>
                                @else
                                  <span class="badge badge-pill badge-warning">Filtro inteligente</span>
                                @endif
                                <?php $sarams = DB::table('socios')->where('status', 'A')->get();?>

                                    <input class="form-control"  list="sarams" name="id_socio">
                                    <datalist id="sarams">
                                        @foreach($sarams as $sas)
                                            <option value="{{$sas->saram}}">{{$sas->saram}}</option>
                                          @endforeach
                                      </datalist>

                              <!--<label>SARAM</label>
                                 <input type="text" class="form-control" id="contato" placeholder="SARAM" name="id_socio" required >
                              </div>-->
                          </div>
                        @endif

                        <div class="row">
                            <div class="col-12" style="margin-top: 30px; margin-left: 25px">
                                <span class="badge badge-pill badge-danger">3º PASSO</span> <button type="submit" class="btn btn-success">ENVIAR</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    <P></P>
                </div><!--FIM DO CARD-->

                </div>




            </div>
<!-- FIM DO BLOCO DE EDIÇÃO -->
@isset($vagas)
@if(Auth::check() && $vagas->count() > 0)
<p></p>
<div class="container">
          <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">Reservas para este dia: @isset ($dt_pesq) {{date('d/m/Y', strtotime($dt_pesq))}} @endisset <span class="badge badge-pill badge-info">Somente DIRETORES podem visualizar estas informações!</span>
              </div>
              <div class="card-body">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Local</th>
                      <th>Sócio</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($vagas as $l)
                    <tr>
                      <td>{{$l->local}}</td>
                      <td>{{$l->socio}}</td>
                      <td>
                        @if ($l->status == 'A')
                            <i class="fas fa-history"></i>
                        @elseif ($l->status == 'C')
                            <i style="color: green" class="fas fa-handshake"></i>
                        @else
                            <i title="{{$l->obs}}" style="color: red" class="fas fa-times-circle"></i>
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
@endif
@endisset
        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script type="text/javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script src="/js/mask/dist/jquery.mask.min.js" ></script>

    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>



    @yield('datatables')

    @php
        if(isset($vg)){
            $vagas = 1;
        }else{
            $vagas = 0;
        };
    @endphp

    <script type="text/javascript">
        $(document).ready(function () {

            $('#reserva').hide();

            var vagas = '<?php echo $vagas;?>';

            if (vagas == 1) {
                $('#reserva').show();
            } else {
                $('#reserva').hide();
            };

             $('[data-toggle="popover"]').popover()
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });

              $('.date').mask('00/00/0000');
              $('.time').mask('00:00:00');
              $('.date_time').mask('00/00/0000 00:00:00');
              $('.cep').mask('00000-000');
              $('.phone').mask('0000-0000');
              $('.phone_with_ddd').mask('(00) 00000-0000');
              $('.phone_us').mask('(000) 000-0000');
              $('.mixed').mask('AAA 000-S0S');
              $('.cpf').mask('000.000.000-00', {reverse: true});
              $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
              $('.money').mask('000.000.000.000.000,00', {reverse: true});
              $('.money2').mask("#.##0,00", {reverse: true});
              $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                  'Z': {
                    pattern: /[0-9]/, optional: true
                  }
                }
              });
              $('.ip_address').mask('099.099.099.099');
              $('.percent').mask('##0,00%', {reverse: true});
              $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
              $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
              $('.fallback').mask("00r00r0000", {
                  translation: {
                    'r': {
                      pattern: /[\/]/,
                      fallback: '/'
                    },
                    placeholder: "__/__/____"
                  }
                });
              $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
        });
    </script>

        <script type="text/javascript">
        $("#cep").focusout(function(){
            //Início do Comando AJAX
            $.ajax({
                //O campo URL diz o caminho de onde virá os dados
                //É importante concatenar o valor digitado no CEP
                url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
                //Aqui você deve preencher o tipo de dados que será lido,
                //no caso, estamos lendo JSON.
                dataType: 'json',
                //SUCESS é referente a função que será executada caso
                //ele consiga ler a fonte de dados com sucesso.
                //O parâmetro dentro da função se refere ao nome da variável
                //que você vai dar para ler esse objeto.
                success: function(resposta){
                    //Agora basta definir os valores que você deseja preencher
                    //automaticamente nos campos acima.
                    $("#logradouro").val(resposta.logradouro);
                    $("#complemento").val(resposta.complemento);
                    $("#bairro").val(resposta.bairro);
                    $("#cidade").val(resposta.localidade);
                    $("#uf").val(resposta.uf);
                    //Vamos incluir para que o Número seja focado automaticamente
                    //melhorando a experiência do usuário
                    $("#numero").focus();
                }
            });
        });
    </script>

</body>
</html>
