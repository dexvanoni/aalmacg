<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Evento;

class Convite extends Model
{
    public function eventos() {
        return $this->belongsTo('App\Evento');
    }
}
