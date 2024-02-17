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
    
        if ($publicidad->advertising && $publicidad->advertising->nombre) {
            $nombrepublicidad = $publicidad->advertising->nombre;
            if ($nombrepublicidad == "Publicidad Store") {
    
                $nombreCliente = $publicidad->cliente->nombre;
                $logoCliente = $publicidad->cliente->logo_url;
                $article = articles::where('spot_id', $publicidad->id)->first();
                $image = images::where('spot_id', $publicidad->id)->where('prioridad_id', 1)->first();
                $video = videos::where('spot_id', $publicidad->id)->first();
                $redes = redes::where('spot_id', $publicidad->id)->get();
                $store = sells::where('spot_id', $publicidad->id)->get();
                return view('Glifoo-publicidad.tienda', compact('nombreCliente', 'article', 'image', 'video', 'redes', 'logoCliente', 'store'));
            } elseif ($nombrepublicidad == "publicidad con mapa") {
                echo ("su publicidad es una publicidad con mapa ");
            } elseif ($nombrepublicidad == "publicidad sin mapa") {
                echo ("su publicidad es una publicidad sin mapa ");
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
