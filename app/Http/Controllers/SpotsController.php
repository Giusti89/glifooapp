<?php

namespace App\Http\Controllers;

use App\Models\advertisings;
use App\Models\articles;
use App\Models\cliente;
use App\Models\spots;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpotsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publi = spots::paginate(5);
        return view('publicidad.index', compact('publi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = cliente::pluck('id', 'nombre');
        $publi = advertisings::get(['id', 'nombre', 'descripcion']);
        return view('spots.create', compact('publi', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'cliente.required' => 'Seleccione un cliente.',
            'publicidad.required' => 'Seleccione una publicidad.',
            'slug.required' => 'Ingresar la URL valida.',
            'slug.unique' => 'El slug ya existe.',

            'image.required' => 'El archivo de la imagen debe ser seleccionado.',
            'image.image' => 'El archivo de la imagen debe ser una imagen.',
            'image.mimes' => 'El archivo de la imagen debe ser de tipo: :values.',
        ];

        $request->validate([
            'cliente' => 'required',
            'publicidad' => 'required',
            'slug' => 'required|unique:spots,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp',
        ], $messages);

        $spot = new spots;
        $spot->cliente_id = $request->cliente;
        $spot->advertising_id = $request->publicidad;
        $nombreProducto = $request->slug;
        $slug = Str::slug($nombreProducto);

        $spot->slug = $slug;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = Storage::putFile('public/publicidad/botones', $request->file('image'));
            $nuevo_path = str_replace('public/', '', $path);
            $spot->boton = $nuevo_path;
        }
        $spot->save();

        return redirect()->route('publicidad.index')->with('success', 'Publicidad creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(spots $spots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $publicidad = spots::find($id);
        if (!$publicidad) {
            // Si la solicitud no existe, puedes redirigir a una página de error o a otra página
            return redirect()->route('publicidad.index')->with('error', 'publicidad inexistente.');
        }

        $publi = advertisings::get(['id', 'nombre', 'descripcion']);

        if ($publicidad) {
            $id = $publicidad->id;
            $clienteId = $publicidad->cliente_id;
            $boton = $publicidad->boton;
            $advertisingId = $publicidad->advertising_id;
        }

        return view('spots.edit', compact('publicidad', 'advertisingId', 'publi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'publicidad' => 'required|exists:advertisings,id',
            'image' => 'image|mimes:jpeg,png,webp|max:2048',
        ]);
    
        $spot = spots::find($id);
    
        if (!$spot) {
            return redirect()->route('publicidad.index')->with('error', 'Spot no encontrado.');
        }
    
        $cambiosRealizados = false;
    
        if ($spot->advertising_id != $request->publicidad) {
            $spot->advertising_id = $request->publicidad;
            $cambiosRealizados = true;
        }
    
        if ($request->hasFile('image')) {
            $file = $request->file('image');
    
            if ($spot->boton) {
                Storage::delete('public/' . $spot->boton);
            }
    
            $path = Storage::putFile('public/publicidad/botones', $file);
    
            $nuevo_path = str_replace('public/', '', $path);
            $spot->boton = $nuevo_path;
            $cambiosRealizados = true;
        }
    
        if ($cambiosRealizados) {
            $spot->save();
            return redirect()->route('publicidad.index')->with('success', 'Spot actualizado exitosamente.');
        }
    
        return redirect()->route('publicidad.index')->with('warning', 'No se realizaron cambios en el spot.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $spot = Spots::findOrFail($id);
            $count = articles::where('spot_id', $spot->id)->count();

            if ($count > 0) {
                return redirect()->route('publicidad.index')->with('error', 'La publicidad no puede ser eliminada');
            } else {
                $spot->delete();
                if ($spot->boton) {
                    Storage::delete('public/' . $spot->boton);
                }

                return redirect()->route('publicidad.index')->with('success', 'Publicidad eliminada correctamente.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->route('publicidad.index')->with('error', 'La publicidad no pudo ser encontrada.');
        } catch (\Exception $e) {
            return redirect()->route('publicidad.index')->with('error', 'No se puede borrar la publicidad.');
        }
    }

    public function pstore($id)
    {
        $spotId = $id;
        $spot = spots::find($id);
        if (!$spot) {
            return redirect()->route('publicidad.index')->with('error', 'Spot no encontrado.');
        }

        $articles = Articles::where('spot_id', $spotId)->paginate(1);
        $count = Articles::where('spot_id', $id)->count();

        $identificador = $id;
        return view('publicidad.pubstore', compact('identificador', 'articles', 'count'));
    }
}
