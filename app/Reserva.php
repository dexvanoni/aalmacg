<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['socio', 'id_socio', 'tipo', 'local', 'dt_evento', 'periodo', 'alcool', 'piscina', 'campos_quadras_parques', 'valor_pago', 'status', 'diretor', 'pago', 'obs', 'contato'];
}
