<?php

namespace App\Http\Controllers;

use App\Models\images;
use App\Models\prioritys;
use App\Models\spots;
use App\Models\videos;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;


class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $identificador = $id;

        $prio = prioritys::pluck('nombre', 'id');
        $imagenes = images::with('priority')->where('spot_id', $id)->paginate(2);

        $count = $imagenes->total();
        $video = videos::where('spot_id', $id)->first();
        
        $advertisingNombre = $video->spot->advertising->nombre;

        return view('galeria.index', compact('imagenes', 'identificador', 'count', 'prio', 'count', 'advertisingNombre'));
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
        $messages = [
            'prioridad.required' => 'Introducir el nombre de la red social.',

            'image.required' => 'El archivo de la imagen debe ser seleccionada.',
            'image.image' => 'El archivo de la imagen debe ser una imagen.',
            'image.mimes' => 'El archivo de la imagen debe ser de tipo: :values.',
        ];

        $request->validate([
            'prioridad' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], $messages);

        $imagen = new images;

        $imagen->prioridad_id = $request->prioridad;
        $imagen->spot_id = $request->iden;



        $nombreCliente = $imagen->spot->cliente->nombre;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Construir la ruta de almacenamiento con el nombre del cliente
            $path = Storage::putFile("public/publicidad/$nombreCliente/imagenes", $file);

            // Actualizar la ruta de la imagen en la base de datos
            $nuevoPath = str_replace('public/', '', $path);
            $imagen->ruta = $nuevoPath;
        }
        $imagen->save();
        return redirect()->route('galeria.index', $request->iden)->with('success', 'Imagen creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(images $images)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $imgg = images::find($id);
        $prio = prioritys::get(['id', 'nombre']);

        if (!$imgg) {
            return redirect()->route('publicidad.index')->with('error', 'Imagen  inexistente.');
        } else {
            // Si $reed no es nulo, puedes acceder a sus propiedades            
            $spot_id = $imgg->prioridad_id;
            return view('galeria.edit', compact('imgg', 'prio', 'spot_id'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $imgg = images::find($id);
        if (!$imgg) {
            return redirect()->route('publicidad.index')->with('error', 'Imagen no encontrada.');
        }
        $imgg->prioridad_id = $request->prioridad;
        $nombreCliente = $imgg->spot->cliente->nombre;

        if ($request->hasFile('image')) {
            $file = $request->file('image');


            if ($imgg->ruta) {
                Storage::delete('public/' . $imgg->ruta);
            }

            $path = Storage::putFile("public/publicidad/$nombreCliente/imagenes", $file);

            $nuevo_path = str_replace('public/', '', $path);
            $imgg->ruta = $nuevo_path;
        }

        $imgg->save();

        return redirect()->route('galeria.index', $imgg->spot_id)->with('success', 'Imagen actualizada exitosamente.');
    }

    public function cambio($id)
    {
        $spot = spots::find($id);
        $spot->estado = 1;
        $spot->update();
        return redirect()->route('publicidad.index')->with('success', 'Spot sera publicado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $red = images::findOrFail($id);
        // Eliminar imagen asociada si existe
        if ($red->ruta) {
            Storage::delete('public/' . $red->ruta);
        }

        // Eliminar el registro del spot
        $red->delete();

        return redirect()->route('galeria.index', $red->spot_id)->with('success', 'Imagen eliminada correctamente.');
    }
}
