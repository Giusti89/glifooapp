<?php

namespace App\Http\Controllers;

use App\Models\articles;
use App\Models\images;
use App\Models\redes;
use App\Models\sells;
use App\Models\spots;
use App\Models\videos;
use Illuminate\Http\Request;

class PubliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boton = spots::all();
        return view('publi', compact('boton'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $publicidad = spots::where('slug', $slug)->first();

        if (!$publicidad) {
            return redirect()->route('error');
        }
        $nombreCliente = $publicidad->cliente->nombre;
        $logoCliente = $publicidad->cliente->logo_url;
        $article = articles::where('spot_id', $publicidad->id)->first();
        $image = images::where('spot_id', $publicidad->id)->where('prioridad_id', 1)->first();
        $images = images::where('spot_id', $publicidad->id)->where('prioridad_id', 2)->get();
        $video = videos::where('spot_id', $publicidad->id)->first();
        $redes = redes::where('spot_id', $publicidad->id)->get();
        if ($publicidad->advertising && $publicidad->advertising->nombre) {
            $nombrepublicidad = $publicidad->advertising->nombre;
            if ($nombrepublicidad == "Publicidad Store") {

                $store = sells::where('spot_id', $publicidad->id)->get();

                return view('Glifoo-publicidad.tienda', compact('nombreCliente', 'article', 'image', 'video', 'redes', 'logoCliente', 'store'));

            } elseif ($nombrepublicidad == "publicidad con mapa") {

                $direccionCliente = $publicidad->cliente->direccion;
                return view('Glifoo-publicidad.conmap', compact('nombreCliente', 'image','article', 'redes','images', 'video','logoCliente','direccionCliente'));

            } elseif ($nombrepublicidad == "publicidad sin mapa") {
                
                return view('Glifoo-publicidad.sinmap', compact('nombreCliente', 'image','article', 'redes','images', 'video','logoCliente'));
            }
        }
    }
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
