<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = ['nombre', 'correo', 'clave'];

    protected $hidden = ['clave'];

    protected $casts = [
        'clave' => 'hashed',
    ];
}
