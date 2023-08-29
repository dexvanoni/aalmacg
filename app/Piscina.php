<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piscina extends Model
{
    protected $fillable = ['carteira_id', 'num_pulseira', 'convidado', 'obs'];
    
}
