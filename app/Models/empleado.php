<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class empleado extends Model
{
    protected $fillable = [
        'identidad',
        'nombre',
        'apellido',
        'correo',
        'cargo',
        'salario',
        'fecha_ingreso',
        'estado',
    ];
}
