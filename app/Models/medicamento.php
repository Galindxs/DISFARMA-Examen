<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class medicamento extends Model
{
    protected $fillable = [
         'sku',
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
}
