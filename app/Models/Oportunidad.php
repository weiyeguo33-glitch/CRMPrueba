<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

//modelo de oortunidad
class Oportunidad extends Model
{
    //nombre de la tabla
    protected $table = 'oportunidades';
    protected $fillable = [
        'titulo',
        'monto_estimado',
        'estado',
        'cliente_id',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
