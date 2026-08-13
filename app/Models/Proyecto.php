<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    Protected $fillable = ['nombre', 'fecha_inicio', 'estado', 'responsable', 'monto', 'created_by'];
}
