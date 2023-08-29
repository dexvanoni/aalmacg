@extends('layouts.padrao')

@section('titulo')
ALSS - Livros de Serviço
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
                <div class="card-header">Lista de Livros de Serviço <a style="color: green" title="Novo Livro" href="{{route('livro.create')}}"><i class="fas fa-plus-circle"></i></a></div>

                <div class="card-body">
                    <table class="table" id="lista_livros">
                        <thead>
                            <tr>
                                <th>Diretor</th>
                                <th>Dt. Serviço</th>
                                <th>Alterações</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($livros as $s)
                                <tr>
                                    <td>
                                       {{$s->nome_guerra}}
                                    </td>
                                    <td>
                                       {{date('d/m/Y', strtotime($s->dt_sv))}}
                                    </td>
                                    <td>
                                    	@if(!is_null($s->ocorrencias))
                                    		<i style="color: red" class="fas fa-exclamation-triangle"></i>
                                    	@endif
                                    </td>
                                    <td>
                                    	<a style="margin-right: 5px" title="VER O LIVRO" href="{{route('livro.show', $s->id)}}">
	                                        <i style="color: green" class="fas fa-search-plus"></i>
	                                     </a>
                                    	@if(Auth::user()->name == $s->nome_guerra)
	                                       <a style="margin-right: 5px" title="EDITAR" href="{{route('livro.edit', $s->id)}}">
	                                        <i style="color: blue" class="fas fa-user-edit"></i>
	                                       </a>
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
          $('#lista_livros').DataTable({
            "order": [[ 1, "desc" ]],
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