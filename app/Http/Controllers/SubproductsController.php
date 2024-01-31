<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\subproducts;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Echo_;
use App\Models\detalles;

class SubproductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $idprod = $id;

        $pro = productos::find($id);

        $subproductos = Subproducts::where('producto_id', $id)->paginate(5);

        if (!$pro) {
            return redirect()->route('cservicios.index')->with('error', 'El subproducto no existente.');
        }
        return view('subproductos.index', compact('subproductos', 'idprod'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('subproductos.nuevo', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El campo nombre debe tener al menos :min caracteres.',
            'nombre.max' => 'El campo nombre no debe tener más de :max caracteres.',
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.unique' => 'El código ya existe en la base de datos.',
            'codigo.min' => 'El campo código debe tener al menos :min caracteres.',
            'costo.required' => 'El campo costo es obligatorio.',
            'costo.numeric' => 'El campo costo debe ser un número.',
            'costo.regex' => 'El campo costo debe ser un número válido con hasta dos decimales.'
        ];
        $request->validate([
            "nombre" => "required|min:5|max:150",
            "codigo" => "required|unique:subproducts|min:4",
            "costo" => "required|numeric|regex:/^[0-9]+(\.[0-9]{1,2})?$/"

        ], $messages);
        $sprod = new subproducts;
        $sprod->nombre = $request->nombre;
        $sprod->codigo = $request->codigo;
        $sprod->costo = $request->costo;
        $sprod->producto_id = $request->producto;
        $sprod->save();
        return redirect()->route('subproductos', $request->producto);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subproducts $subproducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, subproducts $subproducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subproducts)
    {
        $existe = Detalles::where('subprod_id', $subproducts)->exists();

        if (!$existe) {
            $servicio = subproducts::find($subproducts);
            $servicio->delete();
            return redirect()->back()->with('success', 'Producto eliminado correctamente.');
        } else {
            return redirect()->back()->with('error', 'el subproducto no puede ser eliminado por que ya se ecuentra siendo utilizado');
        }
    }
}
