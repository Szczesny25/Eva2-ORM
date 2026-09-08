<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    /**
     * Nombre de la tabla asociada al modelo.
     * (Eloquent asumiría "usuarios" por convención, se deja explícito para claridad)
     */
    protected $table = 'usuarios';

    /**
     * Atributos que se pueden asignar de forma masiva (create()/fill()).
     */
    protected $fillable = [
        'nombre',
        'correo',
        'clave',
    ];

    /**
     * Atributos que no queremos mostrar cuando el modelo se convierte
     * a array o JSON (por ejemplo, al devolver el usuario en una respuesta).
     */
    protected $hidden = [
        'clave',
    ];

    /**
     * Relación: un usuario puede tener muchos proyectos creados por él.
     */
    public function proyectos()
    {
        return $this->hasMany(Proyecto::class, 'created_by');
    }
}
