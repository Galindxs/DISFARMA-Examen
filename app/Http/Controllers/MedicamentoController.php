<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class MedicamentoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = trim((string) $request->input('buscar'));

        $medicamentos = Medicamento::query()
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('codigo', 'like', "%{$buscar}%");
                });
            })
            ->orderBy('nombre')
            ->paginate(10)
            ->withQueryString();

        return view('medicamentos.index', compact('medicamentos', 'buscar'));
    }

    public function create()
    {
        return view('medicamentos.create', [
            'categorias' => Medicamento::CATEGORIAS,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validar($request);

        $data['fecha_registro'] = now()->toDateString();

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $this->guardarImagen($request);
        }

        Medicamento::create($data);

        return redirect()
            ->route('medicamentos.index')
            ->with('success', 'Medicamento registrado correctamente.');
    }

    public function edit(Medicamento $medicamento)
    {
        return view('medicamentos.edit', [
            'medicamento' => $medicamento,
            'categorias' => Medicamento::CATEGORIAS,
        ]);
    }

    public function update(Request $request, Medicamento $medicamento)
    {
        $data = $this->validar($request, $medicamento);

        $data['fecha_registro'] = $medicamento->fecha_registro?->toDateString()
            ?? now()->toDateString();

        if ($request->hasFile('imagen')) {
            $this->eliminarImagen($medicamento->imagen);
            $data['imagen'] = $this->guardarImagen($request);
        }

        $medicamento->update($data);

        return redirect()
            ->route('medicamentos.index')
            ->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamento $medicamento)
    {
        $this->eliminarImagen($medicamento->imagen);
        $medicamento->delete();

        return redirect()
            ->route('medicamentos.index')
            ->with('success', 'Medicamento eliminado correctamente.');
    }

    private function validar(Request $request, ?Medicamento $medicamento = null): array
    {
        return $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('medicamentos', 'codigo')->ignore($medicamento?->id),
            ],
            'nombre' => ['required', 'string', 'max:150'],
            'categoria' => ['required', Rule::in(Medicamento::CATEGORIAS)],
            'precio' => ['required', 'numeric', 'gt:0'],
            'costo' => ['required', 'numeric', 'gte:0'],
            'inventario' => ['required', 'integer', 'min:0'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'laboratorio' => ['required', 'string', 'max:150'],
            'fecha_vencimiento' => ['required', 'date'],
            'numero_lote' => ['required', 'string', 'max:80'],
        ], [
            'codigo.required' => 'El código SKU es obligatorio.',
            'codigo.unique' => 'Ya existe un medicamento con ese código SKU.',
            'nombre.required' => 'El nombre del medicamento es obligatorio.',
            'categoria.required' => 'Seleccione una categoría.',
            'categoria.in' => 'La categoría seleccionada no es válida.',
            'precio.required' => 'El precio de venta es obligatorio.',
            'precio.gt' => 'El precio de venta debe ser mayor que cero.',
            'costo.required' => 'El costo es obligatorio.',
            'costo.gte' => 'El costo no puede ser negativo.',
            'inventario.required' => 'El inventario es obligatorio.',
            'inventario.integer' => 'El inventario debe ser un número entero.',
            'inventario.min' => 'El inventario no puede ser negativo.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.mimes' => 'La imagen debe ser JPG, PNG o WEBP.',
            'imagen.max' => 'La imagen no debe superar los 5 MB.',
            'laboratorio.required' => 'El laboratorio es obligatorio.',
            'fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'fecha_vencimiento.date' => 'Ingrese una fecha de vencimiento válida.',
            'numero_lote.required' => 'El número de lote es obligatorio.',
        ]);
    }

    private function guardarImagen(Request $request): string
    {
        $directorio = public_path('uploads/medicamentos');
        File::ensureDirectoryExists($directorio);

        $archivo = $request->file('imagen');
        $nombre = Str::uuid()->toString().'.'.$archivo->getClientOriginalExtension();

        $archivo->move($directorio, $nombre);

        return $nombre;
    }

    private function eliminarImagen(?string $imagen): void
    {
        if ($imagen) {
            File::delete(public_path('uploads/medicamentos/'.$imagen));
        }
    }
}
