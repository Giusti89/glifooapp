<?php

namespace App\Http\Controllers;

use App\Models\articles;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $articulo = new articles;
        $articulo->spot_id = $request->iden;
        $articulo->titulo = $request->titulo;
        $articulo->contenido = $request->contenido;

        $articulo->save();
        return redirect()->route('storepub', ['id' => $request->iden])->with('success', 'publicidad creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(articles $articles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, articles $articles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $articulo = Articles::findOrFail($id);
        $articulo->delete();
        return redirect()->route('storepub', ['id' => $articulo->spot_id, 'page' => 1])->with('error', 'Articulo eliminado correctamente.');
    }
}
