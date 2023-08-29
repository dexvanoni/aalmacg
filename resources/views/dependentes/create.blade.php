@extends('layouts.padrao')

@section('titulo')
ALSS - Novo Dependente
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
                width: 30px;
                height: 15px;
            }

</style>
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Novo Dependente do {{$socio->posto_grad}} {{$socio->nome_guerra}} - SARAM: {{$socio->saram}} </div>

                <div class="card-body">

                	<form action="{{ route('dependente.store') }}" method="POST" enctype="multipart/form-data">
                		@csrf

                        <input type="hidden" name="socio_id" value="{{$socio->id}}"> 

                		<!--PRIMEIRA LINHA-->
                		<div class="row">
                			<div class="col-8">
                				<label>Nome Completo</label>
                			 <input type="text" class="form-control" placeholder="Nome Completo" aria-label="Nome Completo" name="nome_completo" required >
                			</div>
                            <div class="col-2">
                                <label>Sexo</label>
                                <select name="sexo" class="form-control" required >
                                    <option>SEXO</option>
                                    <option value="M">M</option>
                                    <option value="F">F</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Dt. Nascimento</label>
                                <input type="text" class="form-control" id="date" data-mask="00/00/0000" placeholder="Data Nascimento" aria-label="Data Nascimento" name="dt_nasc" required >
                            </div>
                		  </div>

                		<p></p>
                		
                		<!--SEGUNDA LINHA-->
                		<div class="row">
                			<div class="col-5">
                				<label>Email</label>
                				<input type="email" class="form-control" id="mail" placeholder="Email" aria-label="Email" name="email" required >
                			</div>
                			<div class="col-4">
                				<label>Celular (Whatsapp)</label>
                				<input type="text" data-mask="(00) 00000-0000" class="form-control" id="celular" placeholder="Celular" aria-label="Celular" name="celular" required >
                			</div>
                            <div class="col-3">
                                <label>PIN</label>
                                <input type="number" class="form-control" id="pin" placeholder="PIN" aria-label="PIN" name="pin" value="<?php echo rand(1000, 9999);?>" readonly="readonly">
                            </div>
                		</div>

                		<p></p>
                		<!--TERCEIRA LINHA-->
                		<div class="row">
                			<div class="col-2">
                				<label>CEP</label>
								  <input type="text" class="form-control" placeholder="CEP" data-mask="00000-000" aria-label="CEP" aria-describedby="button-addon2" name="cep" id="cep" required >
                			</div>
                			<div class="col-5">
                				<label>Logradouro</label>
                				<input type="text" class="form-control" id="logradouro" placeholder="Rua" aria-label="Rua" name="rua" readonly="readonly">
                			</div>
                			<div class="col-1">
                				<label>Nº</label>
                				<input type="text" class="form-control" id="numero" placeholder="Nº" aria-label="Nº" name="num_casa" required >
                			</div>
                			<div class="col-4">
                				<label>Bairro</label>
                				<input type="text" class="form-control" id="bairro" placeholder="Bairro" aria-label="Bairro" name="bairro" readonly="readonly">
                			</div>
                			
                		</div>

                		<p></p>
                		<!--QUARTA LINHA-->
                		<div class="row">
                			<div class="col-3">
                				<label>Complemento</label>
                				<input type="text" class="form-control" id="complemento" placeholder="Complemento" aria-label="Complemento" name="complemento">
                			</div>
                            <div class="col-7">
                                <label>Inserir foto</label>
                                <input class="form-control" type="file" id="formFile" name="foto">
                            </div>
                            <div class="col">
                                <p></p>
                                <button style="margin-top: 10px" type="submit" class="btn btn-success">Enviar</button>
                            </div>

                		</div>

                	</form>

                </div>
            </div>

            <hr>
            <label>LISTA DE DEPENDENTES DESTE SÓCIO</label>
            @php
                $dependes = DB::table('dependentes')->where('socio_id', '=', $socio->id)->get();
            @endphp
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome Completo</th>
                        <th>Contato</th>
                        <th>Idade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dependes as $dep)
                        <tr>
                            <td>
                                @if (!is_null($dep->foto))
                                        <a class="foto">
                                            <img class="foto" src="/storage/foto/{{$dep->foto}}">
                                            <span>
                                                <img src="/storage/foto/{{$dep->foto}}" width="100px"  >
                                            </span>
                                        </a>
                                @else
                                         <i class="fas fa-camera"></i>
                                @endif
                            </td>
                            <td>{{$dep->nome_completo}}</td>
                            <td>{{$dep->celular}}</td>
                            <td>@php
                                $dateOfBirth = date('Y-m-d', strtotime($dep->dt_nasc));
                                $years = Carbon\Carbon::parse($dateOfBirth)->age;
                                echo $years;
                            @endphp</td>
                            <td>
                                <a title="IMPRIMIR CARTEIRINHA" href="{{route('dependente.show', $dep->id)}}">
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
@endsection

