<?php

namespace App\Http\Controllers;

use App\Models\advertisings;
use Illuminate\Http\Request;

class AdvertisingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reglas = advertisings::all();
        $reglas = advertisings::paginate(5);
        return view('adveristings.index', compact('reglas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adveristings.create');
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

            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.min' => 'El campo descripción debe tener al menos :min caracteres.',
        ];
        $request->validate([
            "nombre" => "required|min:5|max:150",
            "descripcion" => "required|min:10",          

        ], $messages);


        $reglas = new advertisings;
        $reglas->nombre = $request->nombre;
        $reglas->descripcion = $request->descripcion;
        

        $reglas->save();
        return redirect()->route('adveristings')->with('success', 'Nueva regla creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(advertisings $advertisings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $publi = advertisings::find($id);

        // Verificar si el cliente existe antes de continuar
        if (!$publi) {
            // Manejar el caso en que el cliente no existe, por ejemplo, redireccionar o mostrar un mensaje de error.
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado.');
        }

        return view('adveristings.edit', compact('publi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $messages = [
        'nombre.required' => 'El campo nombre es obligatorio.',
        'nombre.min' => 'El campo nombre debe tener al menos :min caracteres.',
        'nombre.max' => 'El campo nombre no debe tener más de :max caracteres.',

        'descripcion.min' => 'El campo descripción debe tener al menos :min caracteres.',
    ];

    $request->validate([
        "nombre" => "required|min:5|max:150",
        "descripcion" => "min:10",
    ], $messages);

    // Cambia 'advertisings::find($id)' a 'advertisings::findOrFail($id)'
    $cliente = advertisings::findOrFail($id);

    $cliente->nombre = $request->nombre;
    $cliente->descripcion = $request->descripcion;  // Asegúrate de que el nombre del campo sea correcto

    $cliente->save();

    return redirect()->route('adveristings')->with('success', 'La publicidad se actualizó correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = advertisings::findOrFail($id);
    
        $cliente->delete();
    
        return redirect()->route('adveristings')->with('error', 'La publicidad se eliminó correctamente.');
    }
}
