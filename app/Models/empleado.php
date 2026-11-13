<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public const CARGOS = [
        'Regente Farmacéutico',
        'Asistente de Farmacia',
        'Jefe de Bodega',
        'Despachador',
        'Cajero',
    ];

    public const ESTADOS = ['Activo', 'Inactivo'];

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

    protected function casts(): array
    {
        return [
            'salario' => 'decimal:2',
            'fecha_ingreso' => 'date',
        ];
    }
}
