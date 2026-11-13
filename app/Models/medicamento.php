<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    public const CATEGORIAS = [
        'Antibióticos',
        'Analgésicos',
        'Sueros',
        'Material Quirúrgico',
        'Vitaminas',
    ];

    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'precio',
        'costo',
        'inventario',
        'imagen',
        'laboratorio',
        'fecha_vencimiento',
        'fecha_registro',
        'numero_lote',
    ];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'costo' => 'decimal:2',
            'inventario' => 'integer',
            'fecha_vencimiento' => 'date',
            'fecha_registro' => 'date',
        ];
    }
}
