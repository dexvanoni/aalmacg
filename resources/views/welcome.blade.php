<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Gestor ALSS</title>

        <!-- Fonts -->
         <!--##########################################################################################################-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<!--##########################################################################################################-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.5/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                background-image: url("/imagens/fundo.jpeg");
                background-size: cover;
                color: white;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        <!--@if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    -->
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="/imagens/logo.png" alt="" width="200px" height="200px"><br>
                    Gestor ALSS
                    @if(Session::has('reserva'))
                        <div class="row">
                            <div class="col-8 mx-auto">
                                <h5 style="color: black; background-color: #ffff99; border: 1px solid yellow !important; padding: 10px; border-radius: 10px; font-size: 15px">{{ Session::get('reserva') }}</h5>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#pagamento">
                            Meios de pagamento
                        </button>
                                                    <!-- Modal -->
                    <div class="modal fade" id="pagamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Meios de pagamento ALSS</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-6">
                                            <img src="/imagens/qrcode.png" alt="qr" width="200px" height="200px">
                                        </div>
                                        <div class="col-6" style="font-size: 15px; color: black; align-items: left">
                                            Faça a leitura do QR-Code ao lado para realizar o pagamento via PIX <br>
                                            CHAVE PIX CNPJ: 08852205000107 ou <br>
                                            Depósito ou transferência para: <br>
                                            Agência: 4319 <br>
                                            C/C: 13000029-0 <br>
                                            Associação das Áreas de Lazer dos Militares da Aeronáutica de Campo Grande
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    @endif
                    <p style="color:rgb(218, 40, 40); font-size: 15px">Desenvolvido por SGT Vanoni | {{Carbon\Carbon::now()->format('Y')}}</p>
                </div>

                <div class="links">
                    <a style="color: black; background-color: #ffff99; border: 1px solid yellow !important; padding: 10px; border-radius: 10px" href="{{route('login_socio')}}"><b>RESERVA</b></a>
                    <a style="color: white" href="{{ route('sobre') }}">A ALSS</a>
                    <a style="color: white" href="http://10.152.16.203/bacg">BACG</a>
                </div>
            </div>
        </div>
        <script>
            $('#pagamento').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
        </script>
    </body>
</html>

