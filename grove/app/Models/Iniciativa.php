<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Iniciativa extends Model
{
    protected $table = 'iniciativas';

    protected $fillable = [
        'nome',
        'categoria',
        'descricao',
        'imagem',
    ];

    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
}
