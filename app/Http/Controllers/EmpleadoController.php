<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim((string) $request->input('buscar'));

        $empleados = Empleado::query()
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('apellido', 'like', "%{$buscar}%")
                        ->orWhere('identidad', 'like', "%{$buscar}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('empleados.index', compact('empleados', 'buscar'));
    }

    public function create()
    {
        return view('empleados.create', [
            'cargos' => Empleado::CARGOS,
            'estados' => Empleado::ESTADOS,
        ]);
    }

    public function store(Request $request)
    {
        Empleado::create($this->validar($request));

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado registrado correctamente.');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', [
            'empleado' => $empleado,
            'cargos' => Empleado::CARGOS,
            'estados' => Empleado::ESTADOS,
        ]);
    }

    public function update(Request $request, Empleado $empleado)
    {
        $empleado->update($this->validar($request, $empleado));

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()
            ->route('empleados.index')
            ->with('success', 'Empleado eliminado correctamente.');
    }

    private function validar(Request $request, ?Empleado $empleado = null): array
    {
        return $request->validate([
            'identidad' => [
                'required',
                'digits:13',
                Rule::unique('empleados', 'identidad')->ignore($empleado?->id),
            ],
            'nombre' => ['required', 'string', 'max:120'],
            'apellido' => ['required', 'string', 'max:120'],
            'correo' => ['required', 'email', 'max:150'],
            'cargo' => ['required', Rule::in(Empleado::CARGOS)],
            'salario' => ['required', 'numeric', 'gt:0'],
            'fecha_ingreso' => ['required', 'date'],
            'estado' => ['required', Rule::in(Empleado::ESTADOS)],
        ], [
            'identidad.required' => 'La identidad es obligatoria.',
            'identidad.digits' => 'La identidad debe contener exactamente 13 dígitos.',
            'identidad.unique' => 'Ya existe un empleado con esa identidad.',
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'Ingrese un correo electrónico válido.',
            'cargo.required' => 'Seleccione un cargo.',
            'cargo.in' => 'El cargo seleccionado no es válido.',
            'salario.required' => 'El salario es obligatorio.',
            'salario.gt' => 'El salario debe ser mayor que cero.',
            'fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'fecha_ingreso.date' => 'Ingrese una fecha de ingreso válida.',
            'estado.required' => 'Seleccione el estado del empleado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);
    }
}
