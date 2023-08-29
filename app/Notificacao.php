<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Socio;

class Notificacao extends Model
{

	protected $fillable = ['socio_id', 'referente', 'notificacao', 'nivel'];

    public function socios_notificacao(){
        return $this->belongsTo('App\Socio', 'socio_id');
    }
}
