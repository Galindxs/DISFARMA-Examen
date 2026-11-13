<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    public const CATEGORIAS = [
        'Fármacos',
        'Material Quirúrgico',
        'Equipos',
    ];

    public const DIAS_CREDITO = [15, 30, 45, 60];

    public const ESTADOS = ['Activo', 'Inactivo'];

    protected $table = 'proveedores';

    protected $fillable = [
        'rtn',
        'empresa',
        'contacto',
        'telefono',
        'categoria',
        'limite_credito',
        'dias_credito',
        'estado',
        'fecha_registro',
    ];

    protected function casts(): array
    {
        return [
            'limite_credito' => 'decimal:2',
            'dias_credito' => 'integer',
            'fecha_registro' => 'date',
        ];
    }
}
