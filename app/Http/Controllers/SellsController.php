<?php

namespace App\Http\Controllers;

use App\Models\sells;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SellsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $identificador = $id;
        $tienda = sells::where('spot_id', $id)->paginate(2);
        return view('tienda.index', compact('tienda', 'identificador'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tienda = new sells;
        $tienda->nombre = $request->nombre;
        $tienda->descripcion = $request->contenido;
        $tienda->costo = $request->costo;
        $tienda->spot_id = $request->iden;

        $nombreCliente = $tienda->spot->cliente->nombre;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Construir la ruta de almacenamiento con el nombre del cliente
            $path = Storage::putFile("public/publicidad/$nombreCliente/store", $file);

            // Actualizar la ruta de la imagen en la base de datos
            $nuevoPath = str_replace('public/', '', $path);
            $tienda->ruta = $nuevoPath;
        }
        $tienda->save();
        return redirect()->route('tienda.index', $request->iden)->with('success', 'Articulo creado correctamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(sells $sells)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tienda = sells::find($id);
        
        if (!$tienda) {
            return redirect()->route('publicidad.index')->with('error', 'Articulo inexistente.');
        } else {
            // Si $reed no es nulo, puedes acceder a sus propiedades    
            $spot_id = $tienda->prioridad_id;        
            return view('tienda.edit', compact('tienda'));
        }
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $tienda = sells::find($id);
        if (!$tienda) {
            return redirect()->route('publicidad.index')->with('error', 'Articulo no encontrado.');
        }
        $tienda->nombre=$request->nombre;
        $tienda->descripcion=$request->descripcion;
        $tienda->costo=$request->costo;
        $nombreCliente = $tienda->spot->cliente->nombre;

        if ($request->hasFile('image')) {
            $file = $request->file('image');


            if ($tienda->ruta) {
                Storage::delete('public/' . $tienda->ruta);
            }

            $path = Storage::putFile("public/publicidad/$nombreCliente/store", $file);

            $nuevo_path = str_replace('public/', '', $path);
            $tienda->ruta = $nuevo_path;
        }
        $tienda->save();

        return redirect()->route('tienda.index',$tienda->spot_id)->with('success', 'Articulo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tienda = sells::findOrFail($id);

        if (!$tienda) {
            return redirect()->route('publicidad.index')->with('error', 'Articulo no encontrado.');
        }
        if ($tienda->ruta) {
            Storage::delete('public/' . $tienda->ruta);
        }
        $tienda->delete();

        return redirect()->route('tienda.index', $tienda->spot_id)->with('success', 'Imagen eliminada correctamente.');       
    }
}
