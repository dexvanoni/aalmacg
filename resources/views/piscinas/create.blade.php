@extends('layouts.padrao')

@section('titulo')
ALSS - CONTROLE DE PISCINAS
@endsection

@section('content')
    <div class="container">
    <div class="row justify-content-center">
    	@if(Session::has('piscina'))
            <p class="alert alert-success">{{ Session::get('piscina') }}</p>
        @endif
        @if(Session::has('mensagem'))
            <p class="alert alert-danger">{{ Session::get('mensagem') }}</p>
        @endif
    	<div class="col-md-12">
            <div class="card">
                <div class="card-header">Pesquisa Sócio ou dependente</div>
                <div class="card-body">
                	<form action="{{ route('piscina.pesquisa') }}" method="POST">
                        @csrf
                        <div class="row">
                        	<div class="col-10">
	                        	<label>Nº CARTEIRINHA</label>

                                <?php 
                                    $socs = DB::table('socios')->where('status', 'A')->get();
                                    $deps = DB::table('dependentes')->get();?>

                                    <input class="form-control"  list="carteiras" name="carteira">
                                    <datalist id="carteiras">
                                        @foreach($socs as $s)
                                            <option value="{{$s->carteira}}">{{$s->carteira}}</option>
                                          @endforeach
                                          @foreach($deps as $d)
                                            <option value="{{$d->carteira}}">{{$d->carteira}}</option>
                                          @endforeach
                                      </datalist>

	                        	<!--<input type="text" class="form-control" name="carteira" autofocus>-->
	                    	</div>
                        	<div class="col-2">
                                <p></p>
                           		<button style="margin-top: 10px" type="submit" class="btn btn-success">Enviar</button>
                        	</div>
                        </div>
	                </form>
                </div>
            </div>
        </div>
        <p></p>
        @if(isset($soc) || isset($dep))
    	<hr>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Controle de entrada das piscinas</div>

                <div class="card-body">

                    <form action="{{ route('piscina.store') }}" method="POST">
                        @csrf

					<!--SE É SÓCIO-->
                        @isset($soc)
                        <!--PRIMEIRA LINHA-->
	                        <div class="row">
	                        	<div style="width: 200px;" class="col-3">
	                        		<img style="border: solid blue; max-height: 100%; max-width: 100%" src="/storage/foto/{{$soc->foto}}" >
	                        	</div>
	                        	<div class="col-4">
	                        		<label style="color: blue">Tipo:</label> SÓCIO <br>
	                        		<label style="color: blue">Nome:</label> {{$soc->nome_completo}}<br>
	                        		<label style="color: blue">STATUS:</label>@if($soc->status <> 'A') SÓCIO DESATIVADO! @else ATIVO @endif <br>
	                        		<label style="color: red">Notificações:</label> @if($notificacoes->count() > 0) {{$notificacoes->count()}} @else 0 @endif <br>
	                        		<label style="color: blue">Idade:</label> @php 
	                        			$dateOfBirth = DateTime::createFromFormat('d/m/Y', $soc->dt_nasc)->format('Y-m-d');
                                		$years = Carbon\Carbon::parse($dateOfBirth)->age;
                                		echo $years;
                                	@endphp <br>
                                	<div class="row">
                                		<div class="col-6">
                                		<select class="form-control" name="convidado" required>
		                                	<option selected="selected">Convidado?</option>
		                                    <option value="S">SIM</option>
		                                    <option value="N">NÃO</option>
		                                </select>
                                	</div>
                                	<div class="col-6">
                                		<input type="text" name="num_pulseira" class="form-control" placeholder="Nº PULSEIRA" required> 
                                	</div>
                                	</div>

		                                
	                        	</div>
	                        	<div class="col-5">
	                        	 	<label style="color: blue">OBSERVAÇÕES</label> 
                                	<textarea class="form-control" name="obs" rows="6"></textarea>
	                        	</div>
	                        </div>

	                        <input type="hidden" name="carteira_id" value="{{$soc->carteira}}">
	                    @endisset

	                    <!--SE É DEPENDENTE-->

	                    @isset($dep)
                            <div class="row">
                                <div style="width: 200px;" class="col-3">
                                    <img style="border: solid blue; max-height: 100%; max-width: 100%" src="/storage/foto/{{$dep->foto}}" >
                                </div>
                                <div class="col-4">
                                    <?php $socio_nome = DB::table('socios')->where('id', $dep->socio_id)->first();?>
                                    <label style="color: blue">Tipo:</label> DEPENDENTE DO {{$socio_nome->posto_grad}} {{$socio_nome->nome_guerra}}<br>
                                    <label style="color: blue">Nome:</label> {{$dep->nome_completo}}<br>
                                    <label style="color: blue">STATUS:</label>@if($socio_nome->status <> 'A') SÓCIO DESATIVADO! @else ATIVO @endif <br>
                                    <label style="color: blue">Idade:</label> @php 
                                        $dateOfBirth = $dep->dt_nasc;
                                        $years = Carbon\Carbon::parse($dateOfBirth)->age;
                                        echo $years;
                                    @endphp <br>
                                    <div class="row">
                                        <div class="col-6">
                                        <select class="form-control" name="convidado" required>
                                            <option selected="selected">Convidado?</option>
                                            <option value="S">SIM</option>
                                            <option value="N">NÃO</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="num_pulseira" class="form-control" placeholder="Nº PULSEIRA" required> 
                                    </div>
                                    </div>

                                        
                                </div>
                                <div class="col-5">
                                    <label style="color: blue">OBSERVAÇÕES</label> 
                                    <textarea class="form-control" name="obs" rows="6"></textarea>
                                </div>
                            </div>

                            <input type="hidden" name="carteira_id" value="{{$dep->carteira}}">

	                    @endisset




                        <p></p>
                        <!--SEGUNDA LINHA-->
                        <div class="row">
                            <div class="col">
                                <p></p>
                                <center><button style="margin-top: 10px" type="submit" class="btn btn-success">LIBERAR</button></center>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        @endif
    </div>
    </div>
@endsection

