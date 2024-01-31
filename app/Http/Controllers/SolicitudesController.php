<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use App\Models\detalles;
use App\Models\Service;
use App\Models\solicitudes;
use Illuminate\Http\Request;

class SolicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solicitud = solicitudes::all();
        $solicitud = solicitudes::paginate(5);
        return view('solicitudes.index', compact('solicitud'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = cliente::pluck('id', 'nombre');
        $servicio = Service::pluck('id', 'nombre');
        return view('solicitudes.nuevo', compact('clientes', 'servicio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'concepto.required' => 'El campo concepto es obligatorio.',
            'concepto.min' => 'El campo concepto debe tener al menos :min caracteres.',

            'servicio_id.required' => 'debe seleccionar un servicio.',
            'cliente_id.required' => 'debe seleccionar un cliente.',
        ];
        $request->validate([
            "concepto" => "required|min:5",
            "servicio_id" => "required",
            "cliente_id" => "required"

        ], $messages);
        $solicitud = new solicitudes();
        $solicitud->concepto = $request->concepto;
        $solicitud->servicio_id = $request->servicio_id;
        $solicitud->cliente_id = $request->cliente_id;

        $solicitud->save();
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(solicitudes $solicitudes)
    {
        //
    }

    public function cambioEstado($id)
    {
        $solicitud = solicitudes::find($id);

        $detalles = Detalles::select('detalles.id as detalleID', 'subproducts.nombre as nombres', 'subproducts.costo as costo')
            ->join('subproducts', 'detalles.subprod_id', '=', 'subproducts.id')
            ->where('detalles.solicitud_id', $id)
            ->count();

        if ($detalles == 0) {
            return redirect()->route('solicitudes.index')->with('error', 'La solicitud no se puede dar de alta sin items');
        } else {
            $solicitud->realizado = 1;
            $solicitud->update();
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente');
        }
    }

    public function edit($id)
    {
        $solicitud = solicitudes::find($id);
        if ($solicitud->realizado == 1) {
            return redirect()->route('solicitudes.index')->with('error', 'La solicitud ya está verificada.');
        }


        $solicitud = solicitudes::select('id', 'concepto', 'servicio_id', 'cliente_id')
            ->where('id', $id)
            ->first();
        if (!$solicitud) {
            // Si la solicitud no existe, puedes redirigir a una página de error o a otra página
            return redirect()->route('error')->with('error', 'Solicitud no encontrada.');
        }

        $cliente = cliente::pluck('id', 'nombre');
        $servicio = Service::pluck('id', 'nombre');

        if ($solicitud) {

            $id = $solicitud->id;
            $concepto = $solicitud->concepto;
            $servicioId = $solicitud->servicio_id;
            $clienteId = $solicitud->cliente_id;
        } else {
        }
        return view('solicitudes.edit', compact('solicitud', 'cliente', 'servicio', 'clienteId', 'servicioId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validación de datos
        $request->validate([

            'servicio_id' => 'required',
            'concepto' => 'required|min:5',
            // Agrega las reglas de validación necesarias para otros campos
        ]);

        // Obtener y actualizar la solicitud existente
        $solicitud = solicitudes::findOrFail($id);
        $solicitud->update([
            'cliente_id' => $request->cliente_id,
            'servicio_id' => $request->servicio_id,
            'concepto' => $request->concepto,
            // Actualiza otros campos según sea necesario
        ]);

        // Redireccionar a la vista de solicitudes o a donde sea necesario
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(solicitudes $solicitudes)
    {
        $count = Detalles::where('solicitud_id', $solicitudes->id)->count();
       
        if ($count > 0) {
            
            return redirect()->route('solicitudes.index')->with('error', ' La solicitud no puede ser eliminada');
        } else {
            $solicitud = solicitudes::findOrFail($solicitudes->id);
            $solicitud->delete();
            return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada correctamente');
        }        
    }
}
