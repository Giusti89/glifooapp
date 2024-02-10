<?php

namespace App\Http\Controllers;

use App\Models\spots;
use App\Models\videos;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;


class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $identificador = $id;
        // if (!$vid = spots::find($id)) {
        //     return redirect()->route('publicidad.index')->with('error', 'video no existe.');
        // }

        $videos = videos::where('spot_id', $id)->get(); // Obtén los videos como una colección
        $count = $videos->count(); // Obtén el conteo de videos


        return view('videos.index', compact('videos', 'identificador', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'image.required' => 'Debe seleccionar un archivo de video.',
            'image.file' => 'El archivo seleccionado debe ser un archivo.',
            'image.mimes' => 'El archivo seleccionado debe ser de tipo: :values.',
            'image.max' => 'El tamaño del archivo no puede ser mayor a :max kilobytes.',
        ];
        $request->validate([
            'image' => 'required|file|mimes:mp4,mov,avi|max:81920'

        ], $messages);

        $red = new videos;

        $red->spot_id = $request->iden;
        $nombreCliente = $red->spot->cliente->nombre;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Construir la ruta de almacenamiento con el nombre del cliente
            $path = Storage::putFile("public/publicidad/$nombreCliente", $file);

            // Actualizar la ruta de la imagen en la base de datos
            $nuevoPath = str_replace('public/', '', $path);
            $red->ruta = $nuevoPath;
        }
        $red->save();
        if ($red->save()) {
            return redirect()->route('video.index', $request->iden)->with('success', 'video creado correctamente.');
        } else {
            return redirect()->route('video.index', $request->iden)->with('error', 'video no puedes ser almacenado.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(videos $videos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $vid = videos::find($id);
        // dd($reed);
        if (!$vid) {
            return redirect()->route('publicidad.index')->with('error', 'Red inexistente.');
        } else {
            // Si $reed no es nulo, puedes acceder a sus propiedades
            $spot_id = $vid->spot_id;
            return view('videos.edit', compact('vid'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $red = videos::find($id);

    if (!$red) {
        return redirect()->route('redes.index')->with('error', 'Video no encontrada.');
    }

    $nombreCliente = $red->spot->cliente->nombre;

    // Verifica si se ha cargado un nuevo archivo de video
    if ($request->hasFile('image')) {
        // Elimina el video anterior
        Storage::delete('public/' . $red->ruta);

        // Sube el nuevo video
        $file = $request->file('image');
        $path = Storage::putFile("public/publicidad/$nombreCliente", $file);
        $red->ruta = str_replace('public/', '', $path);
    }

    $red->save();

    return redirect()->route('video.index', $red->spot_id)->with('success', 'Video actualizado correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $red = videos::findOrFail($id);
        // Eliminar imagen asociada si existe
        if ($red->ruta) {
            Storage::delete('public/' . $red->ruta);
        }

        // Eliminar el registro del spot
        $red->delete();

        return redirect()->route('video.index', $red->spot_id)->with('success', 'video eliminado correctamente.');
    }
}
