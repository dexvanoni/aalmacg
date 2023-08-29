@extends('layouts.padrao')

@section('titulo')
ALSS - Novo Sócio
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Novo Sócio</div>

                <div class="card-body">

                	<form action="{{ route('socio.store') }}" method="POST" enctype="multipart/form-data">
                		@csrf

                		<!--PRIMEIRA LINHA-->
                		<div class="row">
                			<div class="col-2">
                				<label>SARAM</label>
                				<input type="number" class="form-control" placeholder="SARAM" aria-label="SARAM" name="saram" required>	
                			</div>
                			<div class="col-2">
                				<label>Grad.</label>
                				<select name="posto_grad" class="form-control" required >
                					<option>Posto/Grad.</option>
                					<!--<option value="T. Brig.">T. Brig.</option>
                					<option value="M. Brig.">M. Brig.</option>
                					<option value="Brig.">Brig.</option>
                					<option value="Cel.">Cel.</option>
                					<option value="T. Cel.">T. Cel.</option>
                					<option value="Maj.">Maj.</option>
                					<option value="Cap.">Cap.</option>
                					<option value="1T">1T</option>
                					<option value="2T">2T</option>
                					<option value="ASP">ASP</option>-->
                					<option value="SO">SO</option>
                					<option value="1S">1S</option>
                					<option value="2S">2S</option>
                					<option value="3S">3S</option>
                					<!--<option value="CB">CB</option>
                					<option value="S1">S1</option>
                					<option value="S2">S2</option>
                					<option value="CV OF.">CV OF.</option>-->
                					<option value="CV SGT.">CV SGT.</option>
                				</select>
                			</div>
                			<div class="col-5">
                				<label>Nome Completo</label>
                			 <input type="text" class="form-control" placeholder="Nome Completo" aria-label="Nome Completo" name="nome_completo" required >
                			</div>
                			<div class="col-3">
                				<label>Nome de Guerra</label>
                				<input type="text" class="form-control" placeholder="Nome de Guerra" aria-label="Nome de Guerra" name="nome_guerra" required >
                			</div>
                		</div>

                		<p></p>
                		
                		<!--SEGUNDA LINHA-->
                		<div class="row">
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
                			<div class="col-4">
                				<label>Email</label>
                				<input type="email" class="form-control" id="mail" placeholder="Email" aria-label="Email" name="email" required >
                			</div>
                			<div class="col-4">
                				<label>Celular (Whatsapp)</label>
                				<input type="text" data-mask="(00) 00000-0000" class="form-control" id="celular" placeholder="Celular" aria-label="Celular" name="celular" required >
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
                			<div class="col-2">
                				<label>Setor</label>
                				<input type="text" class="form-control" id="local_trab" placeholder="Setor" aria-label="Setor" name="local_trab" required >
                			</div>
                			<div class="col-2">
                				<label>Ramal</label>
                				<input type="text" class="form-control" id="ramal" placeholder="Ramal" aria-label="Ramal" name="ramal">
                			</div>
                			<div class="col-2">
                				<label>Nº de Deps.</label>
                				<input type="number" class="form-control" id="num_deps" placeholder="Nº Dep." aria-label="Nº Dep." name="num_deps" required >
                			</div>
                			<div class="col-3">
                				<label>PIN</label>
                				<input type="number" class="form-control" id="pin" placeholder="PIN" aria-label="PIN" name="pin" value="<?php echo rand(1000, 9999);?>" readonly="readonly">
                			</div>
                		</div>
                		
                		<p></p>

                		<!--QUINTA LINHA-->
                		<div class="row">
                			<div class="col-10">
                				Inserir foto
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
        </div>
    </div>
	</div>
@endsection

