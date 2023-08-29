<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//	use App\Convite;

class Evento extends Model
{
    public function convites() {
        return $this->hasMany('App\Convite', 'evento_id');
    }
}
