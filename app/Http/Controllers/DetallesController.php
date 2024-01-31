<?php

namespace App\Http\Controllers;

use App\Models\detalles;
use App\Models\promociones;
use App\Models\subproducts;
use Illuminate\Http\Request;

class DetallesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $marcador = $id;

        $detalles = Detalles::select('detalles.id as detalleID', 'subproducts.nombre as nombres', 'subproducts.costo as costo')
            ->join('subproducts', 'detalles.subprod_id', '=', 'subproducts.id')
            ->where('detalles.solicitud_id', $id)
            ->paginate(10);

        $suma = Detalles::where('solicitud_id', $id)
            ->join('subproducts', 'detalles.subprod_id', '=', 'subproducts.id')
            ->sum('subproducts.costo');

        $sub = subproducts::pluck('id', 'nombre');


        return view('detalle.index', compact('sub', 'marcador', 'detalles', 'suma'));
    }
    public function pdf($id){
        $detalles = Detalles::select('detalles.id as detalleID', 'subproducts.nombre as nombres', 'subproducts.costo as costo')
        ->join('subproducts', 'detalles.subprod_id', '=', 'subproducts.id')
        ->where('detalles.solicitud_id', $id)
        ->paginate(10);

    $suma = Detalles::where('solicitud_id', $id)
        ->join('subproducts', 'detalles.subprod_id', '=', 'subproducts.id')
        ->sum('subproducts.costo');


        return view('detalle.pdf', compact('detalles', 'suma'));

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
        $identf = $request->identificador;
        $prod = new Detalles;
        $prod->subprod_id = $request->subproducto;
        $prod->solicitud_id = $request->identificador;
        $prod->save();
        return redirect()->back()->with('error', 'Producto creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(detalles $detalles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalles $detalles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, detalles $detalles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $detalles)
    {
        $detalle = Detalles::findOrFail($detalles);
        $detalle->delete();

        return redirect()->back()->with('success', 'Detalle eliminado correctamente.');
    }
}
