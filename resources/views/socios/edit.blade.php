@extends('layouts.padrao')

@section('titulo')
ALSS - Editar Sócio
@endsection

@section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar Sócio</div>

                <div class="card-body">

                    <form action="{{ route('socio.update', $socio->id) }}" method="PUT" >
                        @csrf

                        <!--PRIMEIRA LINHA-->
                        <div class="row">
                            <div class="col-2">
                                <label>SARAM</label>
                                <input type="number" class="form-control" placeholder="SARAM" aria-label="SARAM" name="saram" value="{{$socio->saram}}" required>
                            </div>
                            <div class="col-2">
                                <label>Grad.</label>
                               <select name="posto_grad" class="form-control" required value="{{$socio->posto_grad}}">
                                    <option value="SO" {{($socio->posto_grad == 'SO') ? 'selected = selected' : ''}}>SO</option>
                                    <option value="1S" {{($socio->posto_grad == '1S') ? 'selected = selected' : ''}}>1S</option>
                                    <option value="2S" {{($socio->posto_grad == '2S') ? 'selected = selected' : ''}}>2S</option>
                                    <option value="3S" {{($socio->posto_grad == '3S') ? 'selected = selected' : ''}}>3S</option>
                                    <option value="CV SGT.">CV SGT.</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <label>Nome Completo</label>
                             <input type="text" class="form-control" placeholder="Nome Completo" aria-label="Nome Completo" name="nome_completo" value="{{$socio->nome_completo}}"  required >
                            </div>
                            <div class="col-3">
                                <label>Nome de Guerra</label>
                                <input type="text" class="form-control" placeholder="Nome de Guerra" aria-label="Nome de Guerra" name="nome_guerra" value="{{$socio->nome_guerra}}" required >
                            </div>
                        </div>

                        <p></p>

                        <!--SEGUNDA LINHA-->
                        <div class="row">
                            <div class="col-2">
                                <label>Sexo</label>
                                <select name="sexo" class="form-control" value="{{$socio->sexo}}" required >
                                    <option value="M" {{($socio->sexo == 'M') ? 'selected = selected' : ''}}>M</option>
                                    <option value="F" {{($socio->sexo == 'F') ? 'selected = selected' : ''}}>F</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <label>Dt. Nascimento</label>
                                <input type="text" class="form-control" id="date" data-mask="00/00/0000" placeholder="Data Nascimento" aria-label="Data Nascimento" name="dt_nasc" value="{{$socio->dt_nasc}}" required >
                            </div>
                            <div class="col-4">
                                <label>Email</label>
                                <input type="email" class="form-control" id="mail" placeholder="Email" aria-label="Email" name="email" value="{{$socio->email}}" required >
                            </div>
                            <div class="col-4">
                                <label>Celular (Whatsapp)</label>
                                <input type="text" data-mask="(00) 00000-0000" class="form-control" id="celular" placeholder="Celular" aria-label="Celular" name="celular" value="{{$socio->celular}}" required >
                            </div>
                        </div>

                        <p></p>
                        <!--TERCEIRA LINHA-->
                        <div class="row">
                            <div class="col-2">
                                <label>CEP</label>
                                  <input type="text" class="form-control" placeholder="CEP" data-mask="00000-000" aria-label="CEP" aria-describedby="button-addon2" name="cep" id="cep" value="{{$socio->cep}}" required >
                            </div>
                            <div class="col-5">
                                <label>Logradouro</label>
                                <input type="text" class="form-control" id="logradouro" placeholder="Rua" aria-label="Rua" name="rua" value="{{$socio->rua}}" readonly="readonly">
                            </div>
                            <div class="col-1">
                                <label>Nº</label>
                                <input type="text" class="form-control" id="numero" placeholder="Nº" aria-label="Nº" name="num_casa" value="{{$socio->num_casa}}" required >
                            </div>
                            <div class="col-4">
                                <label>Bairro</label>
                                <input type="text" class="form-control" id="bairro" placeholder="Bairro" aria-label="Bairro" name="bairro" value="{{$socio->bairro}}" readonly="readonly">
                            </div>

                        </div>

                        <p></p>
                        <!--QUARTA LINHA-->
                        <div class="row">
                            <div class="col-3">
                                <label>Complemento</label>
                                <input type="text" class="form-control" id="complemento" placeholder="Complemento" aria-label="Complemento" name="complemento" value="{{$socio->complemento}}">
                            </div>
                            <div class="col-2">
                                <label>Setor</label>
                                <input type="text" class="form-control" id="local_trab" placeholder="Setor" aria-label="Setor" name="local_trab" value="{{$socio->local_trab}}" required >
                            </div>
                            <div class="col-2">
                                <label>Ramal</label>
                                <input type="text" class="form-control" id="ramal" placeholder="Ramal" aria-label="Ramal" name="ramal" value="{{$socio->ramal}}">
                            </div>
                            <div class="col-2">
                                <label>Nº de Deps.</label>
                                <input type="number" class="form-control" id="num_deps" placeholder="Nº Dep." aria-label="Nº Dep." name="num_deps" value="{{$socio->num_deps}}" required >
                            </div>
                            <div class="col-3">
                                <label>PIN</label>
                                <input type="number" class="form-control" id="pin" placeholder="PIN" aria-label="PIN" name="pin" value="{{$socio->pin}}" readonly="readonly">
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

