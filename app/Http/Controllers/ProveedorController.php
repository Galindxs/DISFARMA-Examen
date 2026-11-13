<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim((string) $request->input('buscar'));

        $proveedores = Proveedor::query()
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($query) use ($buscar) {
                    $query->where('empresa', 'like', "%{$buscar}%")
                        ->orWhere('rtn', 'like', "%{$buscar}%")
                        ->orWhere('contacto', 'like', "%{$buscar}%");
                });
            })
            ->orderBy('empresa')
            ->paginate(10)
            ->withQueryString();

        return view('proveedores.index', compact('proveedores', 'buscar'));
    }

    public function create()
    {
        return view('proveedores.create', [
            'categorias' => Proveedor::CATEGORIAS,
            'diasCredito' => Proveedor::DIAS_CREDITO,
            'estados' => Proveedor::ESTADOS,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validar($request);

        $data['fecha_registro'] = now()->toDateString();
        $data['dias_credito'] = (int) $data['dias_credito'];

        Proveedor::create($data);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor registrado correctamente.');
    }

    public function edit(Proveedor $proveedor)
    {
        return view('proveedores.edit', [
            'proveedor' => $proveedor,
            'categorias' => Proveedor::CATEGORIAS,
            'diasCredito' => Proveedor::DIAS_CREDITO,
            'estados' => Proveedor::ESTADOS,
        ]);
    }

    public function update(Request $request, Proveedor $proveedor)
    {
        $data = $this->validar($request, $proveedor);

        $data['fecha_registro'] = $proveedor->fecha_registro?->toDateString()
            ?? now()->toDateString();
        $data['dias_credito'] = (int) $data['dias_credito'];

        $proveedor->update($data);

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedor)
    {
        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }

    private function validar(Request $request, ?Proveedor $proveedor = null): array
    {
        return $request->validate([
            'rtn' => [
                'required',
                'digits:14',
                Rule::unique('proveedores', 'rtn')->ignore($proveedor?->id),
            ],
            'empresa' => ['required', 'string', 'max:180'],
            'contacto' => ['required', 'string', 'max:150'],
            'telefono' => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'categoria' => ['required', Rule::in(Proveedor::CATEGORIAS)],
            'limite_credito' => ['required', 'numeric', 'gte:0'],
            'dias_credito' => ['required', 'integer', Rule::in(Proveedor::DIAS_CREDITO)],
            'estado' => ['required', Rule::in(Proveedor::ESTADOS)],
        ], [
            'rtn.required' => 'El RTN es obligatorio.',
            'rtn.digits' => 'El RTN debe contener exactamente 14 dígitos.',
            'rtn.unique' => 'Ya existe un proveedor con ese RTN.',
            'empresa.required' => 'La razón social o empresa es obligatoria.',
            'contacto.required' => 'El nombre del asesor comercial es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.regex' => 'El teléfono debe tener 8 dígitos e iniciar con 2, 3, 8 o 9.',
            'categoria.required' => 'Seleccione un rubro o categoría.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
            'limite_credito.required' => 'El límite de crédito es obligatorio.',
            'limite_credito.numeric' => 'El límite de crédito debe ser numérico.',
            'limite_credito.gte' => 'El límite de crédito no puede ser negativo.',
            'dias_credito.required' => 'Seleccione el plazo de pago.',
            'dias_credito.in' => 'El plazo debe ser de 15, 30, 45 o 60 días.',
            'estado.required' => 'Seleccione el estado del proveedor.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);
    }
}
