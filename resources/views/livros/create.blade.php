@extends('layouts.padrao')

@section('titulo')
ALSS - Livros de Serviço
@endsection

@php
    $ontem = Carbon\Carbon::yesterday()->format('Y-m-d');
    $amanha = Carbon\Carbon::tomorrow()->format('Y-m-d');
    $hoje = Carbon\Carbon::now()->format('Y-m-d');
    $sai = $escalas->where('data_sv', $ontem)->first();
    $entra = $escalas->where('data_sv', $amanha)->first();
    $recebii = Carbon\Carbon::yesterday();
    $recebi = $recebii->subDay()->format('Y-m-d');
    $recebi_do = $escalas->where('data_sv', $recebi)->first();
    //dd($recebi_do);
    //exit;
@endphp

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

        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>ATENÇÃO!</strong> Após a confecção do livro, fazer a impressão ou salvar em PDF.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Livro de:</strong> {{ date('d/m/Y', strtotime($ontem)) }} <strong>- Diretor:</strong> @empty($sai) Escala não lançada! @else{{ $sai->posto_grad }} {{ $sai->nome_guerra }}@endempty</div>
                <form action="{{ route('livro.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                  <label for="passo_ao"><strong>Passo o serviço ao</strong></label>
                                    @empty ($entra)
                                        <input style="color: red" type="text" class="form-control" name="passo_ao" id="" aria-describedby="helpId" placeholder="" value="Escala não lançada!">
                                    @else
                                        <input type="text" class="form-control" name="passo_ao" id="" aria-describedby="helpId" placeholder="" value="{{ $entra->posto_grad }} {{ $entra->nome_guerra }}">
                                    @endempty
                                  <small id="helpId" class="form-text text-muted">Diretor do próximo serviço - {{ date('d/m/Y', strtotime($hoje)) }}</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="passo_ao"><strong>Equipe</strong></label>
                                    <input type="text" class="form-control" name="soldado" id="soldado" aria-describedby="sd">
                                    <small id="sd" class="form-text text-muted">Soldado de serviço (escala)</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="passo_ao"><strong>Recebi o serviço do</strong></label>
                                    @empty ($recebi_do)
                                        <input style="color: red" type="text" class="form-control" name="recebi_do" id="recebi_do" value="Escala não lançada!">
                                    @else
                                        <input type="text" class="form-control" name="recebi_do" id="recebi_do" value="{{ $recebi_do->posto_grad }} {{ $recebi_do->nome_guerra }}" readonly>
                                    @endempty
                                    <small id="helpId" class="form-text text-muted">Diretor do dia - {{ date('d/m/Y', strtotime($recebi)) }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="limpeza"> <strong>Limpeza</strong></label>
                                    <textarea class="form-control" name="limpeza" id="limpeza" cols="30" rows="3"></textarea>
                                    <small id="" class="text-muted">Informar todos os procedimentos de limpeza adotados pela equipe durante o serviço.</small>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="estrutura"> <strong>Estruturas</strong></label>
                                    <textarea class="form-control" name="estrutura" id="estrutura" cols="30" rows="3"></textarea>
                                    <small id="" class="text-muted">Informar todos os problemas encontrados nas estruturas (Ainda não lançados!).</small>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="ocorrencias"> <strong>Ocorrências</strong></label>
                                    <textarea class="form-control" name="ocorrencias" id="ocorrencias" cols="30" rows="3"></textarea>
                                    <small id="" class="text-muted">Informar todas as ocorrências que aconteceram durante o serviço. Disciplina, atrasos, alimentação, etc.</small>
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <button style="margin-top: 10px" type="submit" class="btn btn-success">Enviar</button>
                        </div>
                    </div>
                </form>
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
