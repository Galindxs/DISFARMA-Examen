<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('rtn', 14)->unique();
            $table->string('empresa', 180);
            $table->string('contacto', 150);
            $table->string('telefono', 8);
            $table->enum('categoria', [
                'Fármacos',
                'Material Quirúrgico',
                'Equipos',
            ]);
            $table->decimal('limite_credito', 12, 2);
            $table->integer('dias_credito');
            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');
            $table->date('fecha_registro');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
