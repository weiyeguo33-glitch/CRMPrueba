<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //ombre de la tabla
    protected $table = 'clientes';
    //Sus cositas
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'empresa',
    ];

    public function oportunidades()
    {
        return $this->hasMany(Oportunidad::class);
    }
}
