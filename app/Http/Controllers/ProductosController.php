<?php

namespace App\Http\Controllers;

use App\Models\productos;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $idserv=$id;
        

        $pro = Service::find($id);

        $resultado = Productos::with('servicio')->where('servicio_id', $id)->paginate(5);

        if (!$pro) {
            return redirect()->route('cservicios.index')->with('error', 'El producto no existente.');
        }
        Session::put('idservicio', $idserv);

        return view('productos.index', compact('resultado','idserv'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
       $producto=$id;
        
        return view('productos.nuevo', compact('producto'));
    }

    public function store(Request $request)
    {
            
        $messages = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El campo nombre no puede tener menos de :min caracteres.',
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.unique' => 'El código ingresado ya existe.',
            'producto.required' => 'El campo producto es obligatorio.',
        ];
        $request->validate([
            'nombre' => 'required|min:3',
            'codigo' => 'required|unique:productos,codigo',
            'producto' => 'required',

        ], $messages);

        $prod = new Productos;
        $prod->nombre = $request->nombre;
        $prod->codigo = $request->codigo;
        $prod->servicio_id = $request->producto;

        $prod->save();
        return redirect()->route('mostrarprod',$request->producto)->with('success', 'Producto agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productos $productos)
    {
        //  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, productos $productos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Productos $producto)
    {
        if ($producto->subproductos()->count() > 0) {
            return redirect()->route('cservicios.index', $producto->servicio_id)->with('error', 'No puedes eliminar el producto, ya que tiene subproductos asociados.');
        }
    
        // Si no hay subproductos asociados, puedes eliminar el producto
        $producto->delete();
    
        return redirect()->route('mostrarprod', $producto->servicio_id)->with('success', 'Producto eliminado correctamente.');
    }
}
