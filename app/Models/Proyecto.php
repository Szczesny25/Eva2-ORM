<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    /**
     * Atributos que se pueden asignar de forma masiva.
     */
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'estado',
        'responsable',
        'monto',
        'created_by',
    ];

    /**
     * Relación: un proyecto pertenece al usuario que lo creó.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'created_by');
    }
}
