<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'iniciativa_id',
        'nome',
        'imagem',
        'data_realizacao',
    ];

    public function iniciativa()
    {
        return $this->belongsTo(Iniciativa::class);
    }
}
