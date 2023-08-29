@extends('layouts.app')

@section('content')
<div class="container">
                <div class="row">
                <div class="col">
                 <center><img src="/imagens/logo.png" alt="" width="200px" height="200px"><br> </center>        
                </div>
            </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('nao_loga'))
                <p class="alert alert-danger">{{ Session::get('nao_loga') }}</p>
            @endif
            <div style="margin-top: 50px" class="card">
                <div class="card-header">ENTRE COM SUAS CREDENCIAIS PARA REALIZAR A PRÉ-RESERVA</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login_socio_dados') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="text" class="col-md-4 col-form-label text-md-right">SARAM</label>

                            <div class="col-md-6">
                                <input id="saram" type="text" class="form-control" name="saram" value="{{ old('saram') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pin" class="col-md-4 col-form-label text-md-right">PIN</label>

                            <div class="col-md-6">
                                <input id="pin" type="password" class="form-control" name="pin" required>
                            </div>
                        </div>
<hr>
                        <center><h6>O código PIN contém 4 dígitos numéricos e <br>foi encaminhado ao email do sócio ao ser realizado o cadastro!</h6></center>

                        <div class="form-group row mb-0">
                            <div class="col">
                                <center><button type="submit" class="btn btn-primary">
                                    Entrar
                                </button></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
