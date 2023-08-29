<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Socio;

class Dependente extends Model
{
	protected $fillable = [
		'socio_id', 'foto', 'nome_completo', 'dt_inscricao', 'sexo', 'dt_nasc', 'email', 'celular', 'rua', 'cep', 'num_casa', 'bairro', 'complemento', 'pin', 'carteira'
		];

    public function socio(){
        return $this->belongsTo('App\Socio', 'socio_id');
    }
}
