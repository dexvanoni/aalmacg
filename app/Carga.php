<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carga extends Model
{
    protected $table = 'cargas';

    protected $fillable =  [
				   			'categoria',
				            'local_primario',
				            'local_real',
				            'valor',
				            'bmp',
				            'ns',
				            'situacao',
				            'controle',
    						];
}
