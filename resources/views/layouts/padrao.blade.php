@php
    $dt = Carbon\Carbon::now();
	$dt->tz = new DateTimeZone('America/Campo_Grande');
    $dt->tz = 'America/Campo_Grande';

    $ontem = Carbon\Carbon::yesterday()->format('Y-m-d');
    $amanha = Carbon\Carbon::tomorrow()->format('Y-m-d');
    $hoje = Carbon\Carbon::now()->format('Y-m-d');
@endphp
<!DOCTYPE html>
<html>
<head>
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('titulo')</title>
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
        .scrollable{
          overflow-y: auto;
          max-height: 150px;
        }
    </style>

	@yield('js_head')

</head>
<body>
	 <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="active">
            <div class="sidebar-header">
                <h3>Gestor ALSS</h3>
                <strong>ALSS</strong>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="{{route('home')}}">
                        <i class="fas fa-home"></i>
                    Dashboard
                    </a>
                </li>
            	<li>
                    <a href="#sociosSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-id-card"></i>
                        Sócios
                    </a>
                    <ul class="collapse list-unstyled" id="sociosSubmenu">
                        <li>
                            <a href="{{route('socio.create')}}">Novo</a>
                        </li>
                        <li>
                            <a href="{{route('socio.index')}}">Gerenciamento</a>
                        </li>
                        <li>
                            <a href="{{route('dependente.index')}}">Dependentes</a>
                        </li>
                        <li>
                            <a href="{{route('notificacao.index')}}">Notificação</a>
                        </li>
                        <!--<li>
                            <a href="{{route('carteira.index')}}">Carteirinha</a>
                        </li>-->
                    </ul>
                </li>
                <li>
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-beer"></i>RESERVAS
                    </a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{route('login_socio')}}">Nova</a>
                        </li>
                        <li>
                            <a href="{{route('reserva.index')}}">Gerenciamento</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-glass-cheers"></i>
                        Eventos
                    </a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="{{route('evento.create')}}">Novo</a>
                        </li>
                        <li>
                            <a href="{{route('evento.create')}}">Gerenciamento</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#avisoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-user-secret"></i>
                           Diretoria
                    </a>
                    <ul class="collapse list-unstyled" id="avisoSubmenu">
                        <li>
                            <a href="{{route('diretor.index')}}">Diretores</a>
                        </li>
                        <li>
                            <a href="{{route('escala.index')}}">Escala</a>
                        </li>
                        <li>
                            <a href="{{route('carga.index')}}">Mat. Carga</a>
                        </li>
                        <li>
                            <a href="{{route('esporte.index')}}">Dir. Esportes</a>
                        </li>
                        <li>
                            <a href="{{route('cautela.index')}}">Cautelas</a>
                        </li>
                        <li>
                            <a href="{{route('aviso.index')}}">Avisos</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#piscinaSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="fas fa-swimmer"></i>
                        Piscina
                    </a>
                    <ul class="collapse list-unstyled" id="piscinaSubmenu">
                        <li>
                            <a href="{{route('piscina.create')}}">Entrada</a>
                        </li>
                        <li>
                            <a href="{{route('piscina.index')}}">Gerenciamento</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('livro.index')}}">
                        <i class="fas fa-book"></i>
                        Livro de Serviço
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="fas fa-question"></i>
                        FAQ
                    </a>
                </li>
            </ul>

            <ul class="list-unstyled CTAs">
                <!--<li>
                    <a href="https://bootstrapious.com/tutorial/files/sidebar.zip" class="download">Download source</a>
                </li>-->
                <li style="text-align: center;">
                    <i class="fas fa-laptop-code"></i><br>Desenvolvido por <br>SGT Vanoni | @ {{\Carbon\Carbon::now()->year}}
                </li>
                <li style="text-align: center;">
                	<img src="/imagens/fab.png" width="100px" height="auto">
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Barra Lateral</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                           <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" style="padding-right: 4.5rem;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    @if (Route::has('register') && Auth::user()->id == 1 || Auth::user()->id == 2)
                                        <a class="dropdown-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            @yield('content')

        </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

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


    <script type="text/javascript">
        $(document).ready(function () {
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
