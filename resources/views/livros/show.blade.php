@extends('layouts.padrao')

@php
    date_default_timezone_set('America/Campo_Grande');
    setlocale(LC_ALL, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
    setlocale(LC_TIME, 'pt_BR.utf-8', 'ptb', 'pt_BR', 'portuguese-brazil', 'portuguese-brazilian', 'bra', 'brazil', 'br');
    $ontem = Carbon\Carbon::yesterday()->format('Y-m-d');
    $amanha = Carbon\Carbon::tomorrow()->format('Y-m-d');
    $hoje = Carbon\Carbon::now()->format('Y-m-d');
    $sai = $escalas->where('data_sv', $ontem)->first();
    $entra = $escalas->where('data_sv', $amanha)->first();
    $socios_hj = $socios->where('dt_inscricao', $livros[0]->dt_sv);
    $dependentes_hj = $dependentes->
    where('dt_inscricao', $livros[0]->dt_sv);
    $dtime = Carbon\Carbon::parse($livros[0]->dt_sv)->format('Y-m-d 00:00:00');
    $dtime2 = Carbon\Carbon::parse($livros[0]->dt_sv)->format('Y-m-d 23:59:59');
    $reservas_hj = $reservas->where('created_at', '>=', $dtime)->where('created_at', '<=', $dtime2);
    $notificacoes_hj = $notificacoes->where('created_at', '>=', $dtime)->where('created_at', '<=', $dtime2);
    $cautelas_hj = $cautelas->where('created_at', '>=', $dtime)->where('created_at', '<=', $dtime2);

    //echo $entra;
    //exit;
@endphp

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
            .peq {
                font-size: 12px;
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

        <p class="alert alert-danger">Os dados apresentados podem ser diferentes do livro impresso!</p>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong>Livro de:</strong> {{ date('d/m/Y', strtotime($livros[0]->dt_sv)) }} <strong>- Diretor:</strong> {{ $livros[0]->nome_guerra }}</div>
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <strong>Recebi o serviço do(a)</strong><br>
                               {{ $livros[0]->recebi_do }}
                            </div>
                            <div class="col-4">
                                <strong>Passo o serviço ao(a)</strong><br>
                                {{ $livros[0]->passo_ao }}
                            </div>
                            <div class="col-4">
                                <strong>Livro criado em</strong><br>
                                {{ date('d/m/Y', strtotime($livros[0]->created_at)) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <strong>Novos Sócios: </strong>{{ $socios_hj->count() }} <br>
                                @php
                                    if (!is_null($socios_hj)) {
                                        foreach ($socios_hj as $socs) {
                                            echo '- '.$socs->posto_grad.' '.$socs->nome_guerra.'  ('.$socs->local_trab.')';
                                        }
                                    }
                                @endphp
                            </div>
                            <div class="col">
                                <strong>Novos Dependentes: </strong>{{ $dependentes_hj->count() }} <br>
                                @php
                                    if (!is_null($dependentes_hj)) {
                                        foreach ($dependentes_hj as $deps) {
                                            $soc_dep = $socios->where('id', $deps->socio_id)->first();
                                            echo '- '.$deps->nome_completo.'  (Sócio: '.$soc_dep->posto_grad.' '.$soc_dep->nome_guerra.')<br>';
                                        }
                                    }
                                @endphp
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-cocktail"></i><strong> Reservas: </strong>{{ $reservas_hj->count() }} <br>
                                <table class="table peq">
                                        <thead>
                                            <tr style="background-color: rgb(145, 145, 145)">
                                                <th>Local</th>
                                                <th>Sócio</th>
                                                <th>Dt. Evento</th>
                                                <th>Valor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                    foreach ($reservas_hj as $r) {
                                        $soc_res = $socios->where('saram', $r->id_socio)->first();
                                ?>
                                        <tr>
                                            <td scope="row">{{ $r->local }}</td>
                                            <td>{{ $soc_res->posto_grad }} {{ $soc_res->nome_guerra }}</td>
                                            <td>{{ $r->dt_evento }}</td>
                                            <td>{{ $r->valor_pago }}</td>
                                        </tr>
                                    </tbody>

                                <?php
                                    }
                                    echo '<strong>Valor total recebido em reservas:</strong> R$ '.$livros[0]->valor_caixa;
                                ?>
                                </table>
                            </div>
                            <div class="col-6">
                                <strong><i class="fas fa-book-dead"></i> Notificações </strong> <br>
                                <table class="table peq">
                                    <thead>
                                        <tr style="background-color: rgb(145, 145, 145)">
                                            <th>Sócio</th>
                                            <th>Notificação</th>
                                            <th>Referente a</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($notificacoes_hj as $n) {
                                                $soc_not = $socios->where('id', $n->socio_id)->first();
                                        ?>
                                        <?php
                                            if ($n->nivel == 1) {
                                        ?>
                                        <tr>
                                            <td scope="row"><i title="Nível 1 - Baixo" class="fas fa-exclamation-triangle"></i>{{ $soc_not->posto_grad }} {{ $soc_not->nome_guerra }}</td>
                                            <td>{{ $n->notificacao }}</td>
                                            <td>{{ $n->referente }}</td>
                                        </tr>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if ($n->nivel == 2) {
                                        ?>
                                        <tr>
                                            <td scope="row"><i title="Nível 2 - Médio" class="fas fa-fire"></i>{{ $soc_not->posto_grad }} {{ $soc_not->nome_guerra }}</td>
                                            <td>{{ $n->notificacao }}</td>
                                            <td>{{ $n->referente }}</td>
                                        </tr>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            if ($n->nivel == 3) {
                                        ?>
                                        <tr>
                                            <td scope="row"><i title="Nível 3 - Alto" class="fas fa-skull-crossbones"></i>{{ $soc_not->posto_grad }} {{ $soc_not->nome_guerra }}</td>
                                            <td>{{ $n->notificacao }}</td>
                                            <td>{{ $n->referente }}</td>
                                        </tr>
                                        <?php
                                            }
                                        ?>

                                        <?php
                                            }
                                            echo '<strong>Número de notificações:</strong> '.$notificacoes_hj->count();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-table-tennis"></i><strong> Cautelas: </strong>{{ $cautelas_hj->count() }} <br>
                                <table class="table peq">
                                        <thead>
                                            <tr style="background-color: rgb(145, 145, 145)">
                                                <th>Retirado por</th>
                                                <th>Material</th>
                                                <th>Status</th>
                                                <th>Condição</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                    foreach ($cautelas_hj as $c) {
                                        $soc_cau = $socios->where('carteira', $c->carteira)->first();
                                        $dep_cau = $dependentes->where('carteira', $c->carteira)->first();
                                ?>
                                        <tr>
                                            <?php
                                                if (!is_null($soc_cau)) {
                                            ?>
                                                    <td scope="row">{{ $soc_cau->posto_grad }} {{ $soc_cau->nome_guerra }}</td>
                                            <?php
                                                } else {
                                            ?>
                                                    <td scope="row">{{ $dep_cau->nome_completo }}</td>
                                            <?php
                                                }
                                            ?>
                                            <td>{{ $c->material }}</td>
                                            <td>{{ $c->status }}</td>
                                            <td>{{ $c->condicao }}</td>
                                        </tr>
                                    </tbody>

                                <?php
                                    }
                                ?>
                                </table>
                            </div>
                            <div class="col-6">
                                <i class="fas fa-hotel"></i><strong> Alterações</strong>
                                <table class="table peq">
                                        <thead>
                                            <tr style="background-color: rgb(145, 145, 145)">
                                                <th>Limpeza</th>
                                                <th>Estrutura</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <tr>
                                                    <td>{{ $livros[0]->limpeza }}</td>
                                                    <td>{{ $livros[0]->estrutura }}</td>
                                                </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <i class="fas fa-user-secret"></i><strong> Ocorrências: </strong>
                                @empty ($livros[0]->ocorrencias)
                                    <div class="alert alert-success" role="alert">
                                        <p>Serviço sem ocorrências!</p>
                                    </div>
                                @else
                                    <div class="alert alert-warning" role="alert">
                                        <p>{{ $livros[0]->ocorrencias }}</p>
                                    </div>
                                @endempty

                            </div>
                        </div>
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
