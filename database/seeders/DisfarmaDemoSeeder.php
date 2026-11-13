<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\Medicamento;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class DisfarmaDemoSeeder extends Seeder
{
    public function run(): void
    {
        $medicamentos = [
            [
                'codigo' => 'MED-001',
                'nombre' => 'Amoxicilina 500 mg',
                'categoria' => 'Antibióticos',
                'precio' => 125.50,
                'costo' => 78.00,
                'inventario' => 35,
                'laboratorio' => 'Laboratorios Droguería Nacional',
                'fecha_vencimiento' => '2027-06-30',
                'fecha_registro' => '2026-01-15',
                'numero_lote' => 'LOT-AMX-2026',
            ],
            [
                'codigo' => 'MED-002',
                'nombre' => 'Acetaminofén 500 mg',
                'categoria' => 'Analgésicos',
                'precio' => 45.00,
                'costo' => 22.50,
                'inventario' => 18,
                'laboratorio' => 'Bayer de Honduras S.A.',
                'fecha_vencimiento' => '2027-03-15',
                'fecha_registro' => '2026-01-20',
                'numero_lote' => 'LOT-ACE-2026',
            ],
            [
                'codigo' => 'MED-003',
                'nombre' => 'Solución fisiológica 0.9%',
                'categoria' => 'Sueros',
                'precio' => 38.00,
                'costo' => 19.00,
                'inventario' => 8,
                'laboratorio' => 'Laboratorios Finlay',
                'fecha_vencimiento' => '2027-08-10',
                'fecha_registro' => '2026-02-01',
                'numero_lote' => 'LOT-SOL-2026',
            ],
            [
                'codigo' => 'MED-004',
                'nombre' => 'Guantes quirúrgicos estériles',
                'categoria' => 'Material Quirúrgico',
                'precio' => 210.00,
                'costo' => 135.00,
                'inventario' => 25,
                'laboratorio' => 'Medical Supplies Honduras',
                'fecha_vencimiento' => '2028-01-31',
                'fecha_registro' => '2026-02-10',
                'numero_lote' => 'LOT-GUA-2026',
            ],
            [
                'codigo' => 'MED-005',
                'nombre' => 'Vitamina C 1000 mg',
                'categoria' => 'Vitaminas',
                'precio' => 95.00,
                'costo' => 52.00,
                'inventario' => 42,
                'laboratorio' => 'Laboratorios Bayer',
                'fecha_vencimiento' => '2027-11-20',
                'fecha_registro' => '2026-03-05',
                'numero_lote' => 'LOT-VIT-2026',
            ],
            [
                'codigo' => 'MED-006',
                'nombre' => 'Ibuprofeno 400 mg',
                'categoria' => 'Analgésicos',
                'precio' => 68.00,
                'costo' => 34.00,
                'inventario' => 6,
                'laboratorio' => 'Laboratorios Droguería Nacional',
                'fecha_vencimiento' => '2027-05-18',
                'fecha_registro' => '2026-03-12',
                'numero_lote' => 'LOT-IBU-2026',
            ],
            [
                'codigo' => 'MED-007',
                'nombre' => 'Azitromicina 500 mg',
                'categoria' => 'Antibióticos',
                'precio' => 185.00,
                'costo' => 112.00,
                'inventario' => 14,
                'laboratorio' => 'Bayer de Honduras S.A.',
                'fecha_vencimiento' => '2027-09-25',
                'fecha_registro' => '2026-03-20',
                'numero_lote' => 'LOT-AZI-2026',
            ],
        ];

        foreach ($medicamentos as $medicamento) {
            Medicamento::updateOrCreate(
                ['codigo' => $medicamento['codigo']],
                $medicamento
            );
        }

        $proveedores = [
            [
                'rtn' => '08011985123456',
                'empresa' => 'Laboratorios Droguería Nacional S. de R.L.',
                'contacto' => 'Lic. Carlos Mendoza',
                'telefono' => '22394500',
                'categoria' => 'Fármacos',
                'limite_credito' => 250000.00,
                'dias_credito' => 30,
                'estado' => 'Activo',
                'fecha_registro' => '2024-03-15',
            ],
            [
                'rtn' => '08011990234567',
                'empresa' => 'Bayer de Honduras S.A.',
                'contacto' => 'Ing. Roberto Flores',
                'telefono' => '22351200',
                'categoria' => 'Fármacos',
                'limite_credito' => 180000.00,
                'dias_credito' => 60,
                'estado' => 'Activo',
                'fecha_registro' => '2024-05-10',
            ],
            [
                'rtn' => '08011992345678',
                'empresa' => 'Medical Supplies Honduras',
                'contacto' => 'Lic. Ana Martínez',
                'telefono' => '83764512',
                'categoria' => 'Material Quirúrgico',
                'limite_credito' => 95000.00,
                'dias_credito' => 45,
                'estado' => 'Activo',
                'fecha_registro' => '2025-01-22',
            ],
            [
                'rtn' => '08011993456789',
                'empresa' => 'Equipos Médicos del Norte',
                'contacto' => 'Ing. José Ramírez',
                'telefono' => '94561230',
                'categoria' => 'Equipos',
                'limite_credito' => 320000.00,
                'dias_credito' => 15,
                'estado' => 'Inactivo',
                'fecha_registro' => '2025-02-14',
            ],
        ];

        foreach ($proveedores as $proveedor) {
            Proveedor::updateOrCreate(
                ['rtn' => $proveedor['rtn']],
                $proveedor
            );
        }

        $empleados = [
            [
                'identidad' => '0801199012345',
                'nombre' => 'María',
                'apellido' => 'López',
                'correo' => 'maria.lopez@disfarma.hn',
                'cargo' => 'Regente Farmacéutico',
                'salario' => 28500.00,
                'fecha_ingreso' => '2021-02-15',
                'estado' => 'Activo',
            ],
            [
                'identidad' => '0801199123456',
                'nombre' => 'Carlos',
                'apellido' => 'Mendoza',
                'correo' => 'carlos.mendoza@disfarma.hn',
                'cargo' => 'Asistente de Farmacia',
                'salario' => 14500.00,
                'fecha_ingreso' => '2022-06-01',
                'estado' => 'Activo',
            ],
            [
                'identidad' => '0801199234567',
                'nombre' => 'Ana',
                'apellido' => 'Martínez',
                'correo' => 'ana.martinez@disfarma.hn',
                'cargo' => 'Jefe de Bodega',
                'salario' => 22000.00,
                'fecha_ingreso' => '2020-09-10',
                'estado' => 'Activo',
            ],
            [
                'identidad' => '0801199345678',
                'nombre' => 'José',
                'apellido' => 'Ramírez',
                'correo' => 'jose.ramirez@disfarma.hn',
                'cargo' => 'Despachador',
                'salario' => 12500.00,
                'fecha_ingreso' => '2023-01-16',
                'estado' => 'Activo',
            ],
            [
                'identidad' => '0801199456789',
                'nombre' => 'Laura',
                'apellido' => 'Cruz',
                'correo' => 'laura.cruz@disfarma.hn',
                'cargo' => 'Cajero',
                'salario' => 11800.00,
                'fecha_ingreso' => '2023-07-03',
                'estado' => 'Activo',
            ],
        ];

        foreach ($empleados as $empleado) {
            Empleado::updateOrCreate(
                ['identidad' => $empleado['identidad']],
                $empleado
            );
        }
    }
}
