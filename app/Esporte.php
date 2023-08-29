<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Esporte extends Model
{
    protected $table = 'esportes';

    protected $fillable =  [
				   			'data_reserva',
				            'local',
				            'resp',
				            'situacao',
    						];
}
