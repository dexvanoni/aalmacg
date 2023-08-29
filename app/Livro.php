<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    protected $fillable = [
            'nome_guerra', 'soldado',
            'dt_sv', 'ocorrencias', 'limpeza', 'estrutura',
            'valor_caixa', 'passo_ao', 'recebi_do',
		];
}
