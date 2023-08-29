<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Socio;

class NotificaSocio extends Model
{
     use HasFactory;

    /**
     * Get the post that owns the comment.
     */
    public function notifica_socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
