@extends('layouts.padrao')

@section('titulo')
ALSS - Novo AVISO aos Diretores
@endsection

@section('content')
	<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Novo AVISO</div>

                <div class="card-body">

                	<form action="{{ route('aviso.store') }}" method="POST">
                		@csrf
                        <div class="row">
                            <div class="col-5">
                                <label><strong>Presidente</strong></label>
                                <input type="text" class="form-control" aria-label="Nome de Guerra" name="nome_guerra" required >
                            </div>
                            <div class="col-4">
                                <label><strong>STATUS</strong></label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status1" value="ATIVO">
                                    <label class="form-check-label" for="status1">ATIVO</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status2" value="PROGRAMÁVEL">
                                    <label class="form-check-label" for="status2">PROGRAMÁVEL</label>
                                  </div>
                            </div>
                            <div class="col-3">
                                <label><strong>Validade</strong></label>
                                <input type="date" class="form-control" aria-label="Validade" name="validade" required >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <label><strong>AVISO</strong></label>
                                <textarea class="form-control" name="aviso" id="" cols="30" rows="3"></textarea>
                            </div>
                        </div>
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
				<script type="text/javascript">
        			var contagem = 0;

				    function duplicarCampos(){
				    var clone = document.getElementById('origem').cloneNode(true);
				    var destino = document.getElementById('destino');
				    destino.appendChild (clone);

				    var camposClonados = clone.getElementsByTagName('input');

				    	for(i=0; i<camposClonados.length;i++){
				        	camposClonados[i].value = '';
				    	}
					}
			</script>
@endsection

