<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicio = Service::all();
        $servicio = Service::paginate(5);
        return view('cservicios.index', compact('servicio'));
    }

    public function mostrar()
    {
        $tarjetas = Service::all();
        return view('servicios', compact('tarjetas'));
    }

    public function avatar()
    {
        $avatars = Service::all();
        return view('portfolio', compact('avatars'));
    }

    public function crearServicio()
    {
        return view('cservicios.nuevopost');
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
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El campo nombre debe tener al menos :min caracteres.',
            'nombre.max' => 'El campo nombre no debe tener más de :max caracteres.',

            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.min' => 'El campo descripción debe tener al menos :min caracteres.',

            'leyenda.required' => 'El campo leyenda es obligatorio.',
            'leyenda.min' => 'El campo leyenda debe tener al menos :min caracteres.',

            'image.image' => 'El archivo de la imagen debe ser una imagen.',
            'image.mimes' => 'El archivo de la imagen debe ser de tipo: :values.',
            'avatar.image' => 'El archivo del avatar debe ser una imagen.',
            'avatar.mimes' => 'El archivo del avatar debe ser de tipo: :values.',

        ];
        $request->validate([
            "nombre" => "required|min:5|max:150",
            "descripcion" => "required|min:10",
            "leyenda" => "required|min:3",
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg,webp',

        ], $messages);


        $servicio = new Service;
        $servicio->nombre = $request->nombre;
        $servicio->descripcion = $request->descripcion;
        $servicio->leyenda = $request->leyenda;

        if ($request->hasFile('image')) {
            $file = $request->file('image');

            $path = Storage::putFile('public/images', $request->file('image'));
            $nuevo_path = str_replace('public/', '', $path);
            $servicio->image_url = $nuevo_path;
        }
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');

            $path = Storage::putFile('public/images/avatars', $request->file('avatar'));
            $nuevo_path = str_replace('public/', '', $path);
            $servicio->avatar = $nuevo_path;
        }
        $servicio->save();
        return redirect()->route('cservicios.index')->with('success', 'Servicio creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)

    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $muestra = Service::find($id);
        return view('cservicios.edit', compact('muestra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $servicio = Service::find($id);
        $servicio->nombre = $request->nombre;
        $servicio->descripcion = $request->descripcion;
        $servicio->leyenda = $request->leyenda;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            Storage::delete('public/' . $servicio->image_url);
            $path = Storage::putFile('public/images', $request->file('image'));

            $nuevo_path = str_replace('public/', '', $path);
            $servicio->image_url = $nuevo_path;
        } else {
            $servicio->image_url;
        }


        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            Storage::delete('public/' . $servicio->avatar);
            $path = Storage::putFile('public/images/avatars', $request->file('avatar'));

            $nuevo_path = str_replace('public/', '', $path);
            $servicio->avatar = $nuevo_path;
        } else {
            $servicio->avatar;
        }
        $servicio->update();
        return redirect()->route('cservicios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($servicio_id)
    {
        
        $servicio = Service::find($servicio_id);

        if (!$servicio) {
            return redirect()->route('cservicios.index')->with('error', 'Servicio no encontrado.');
        }
    
        // Verifica si hay productos asociados al servicio
        $productosAsociados = $servicio->productos()->count();
    
        if ($productosAsociados > 0) {
            return redirect()->route('cservicios.index')->with('error', 'No puedes eliminar el servicio.');
        }
    
        // Elimina las imágenes asociadas al servicio si existen
        if ($servicio->image_url && $servicio->avatar) {
            Storage::delete('public/' . $servicio->image_url);
            Storage::delete('public/' . $servicio->avatar);
        }
    
        // Finalmente, elimina el servicio
        $servicio->delete();
    
        return redirect()->route('cservicios.index')->with('success', 'Servicio eliminado exitosamente.');
    }
}
