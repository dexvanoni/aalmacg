<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Dependente;
use App\Notificacao;

class Socio extends Model
{
	protected $fillable = ['saram', 'foto', 'posto_grad', 'nome_completo', 'nome_guerra', 'dt_inscricao', 'sexo', 'dt_nasc', 'email', 'celular', 'ramal', 'local_trab', 'rua', 'cep', 'num_casa', 'bairro', 'complemento', 'num_deps', 'pin', 'status', 'carteira'];

    public function dependentes(){
        return $this->hasMany('App\Dependente');
    }

    public function notificacoes(){
        return $this->hasMany('App\Notificacao');
    }
}
