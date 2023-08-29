<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diretor extends Model
{

  	protected $table = 'diretores';
    
    protected $fillable =  [
				   			'saram',
				            'nome_completo',
				            'nome_guerra',
				            'status',
				            'posto_grad',
				            'funcao',
				            'saram',
				            'local_trab',
				            'contato',
				            'email'
    						];
}
