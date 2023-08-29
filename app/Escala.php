<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Escala extends Model
{
    protected $fillable = [
		'posto_grad', 'nome_guerra', 'data_sv', 'cor_sv'
		];
}
