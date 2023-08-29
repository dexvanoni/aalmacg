@extends('layouts.padrao')

@section('titulo')
ALSS - Novo Diretor
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Novo Diretor</div>

                <div class="card-body">

                	<form action="{{ route('diretor.store') }}" method="POST" enctype="multipart/form-data">
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
                					<option value="SO">SO</option>
                					<option value="1S">1S</option>
                					<option value="2S">2S</option>
                					<option value="3S">3S</option>
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
                			<div class="col-4">
                				<label>Email</label>
                				<input type="email" class="form-control" id="mail" placeholder="Email" aria-label="Email" name="email" required >
                			</div>
                			<div class="col-4">
                				<label>Celular (Whatsapp)</label>
                				<input type="text" data-mask="(00) 00000-0000" class="form-control" id="celular" placeholder="Celular" aria-label="Celular" name="contato" required >
                			</div>
                			<div class="col-4">
                				<label>STATUS</label>
                				<select name="status" class="form-control" required >
                					<option>Status</option>
                					<option value="A">ATIVO</option>
                					<option value="D">DESATIVADO</option>
                				</select>
                			</div>
                		</div>

                		<p></p>

                		<!--QUARTA LINHA-->
                		<div class="row">
                			<div class="col-3">
                				<label>Função</label>
                				<select name="funcao" class="form-control" required >
                					<option>SELECIONE...</option>
                					<option value="PRESIDÊNCIA">PRESIDÊNCIA</option>
                					<option value="FINANCEIRO">FINANCEIRO</option>
                					<option value="ESPORTE">ESPORTE</option>
                					<option value="ADMINISTRATIVO">ADMINISTRATIVO</option>
                					<option value="ESCALA">ESCALA</option>
                					<option value="EVENTOS">EVENTOS</option>
                					<option value="INFORMÁTICA">INFORMÁTICA</option>
                				</select>
                			</div>
                			<div class="row-4">
                				<label>Seção</label>
                				<input type="text" class="form-control" placeholder="Local de trabalho" aria-label="Local de trabalho" name="local_trab" required >
                			</div>
                		</div>
                		
                		<p></p>

                		<!--QUINTA LINHA-->
                		<div class="row">
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

