<x-layouts.menus url="../../css/detalle.css">
    <div class="msj">
        @if (session('error'))
            <div class="alert alert-danger">
                <div class="mensajes">
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <div class="mensajessucess">
                    {{ session('success') }}
                </div>
            </div>
        @endif
    </div>

    <div class="principal">
        <div class="lienzo">
            <div class="cuer">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Costo</th>                                  
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles as $detalle)
                                <tr>
                                    <td class="filas-tabla">
                                        {{ $detalle->detalleID }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $detalle->nombres }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $detalle->costo }}
                                    </td>

                                    
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>BALANCE</th>
                                <td class="filas-tabla" colspan="1"></td>

                                <td class="filas-tabla" colspan="1"> {{ $suma }}</td>

                            </tr>

                        </tfoot>
                    </table>
                    <div class="botones">
                       
                        <a href="{{ route('solicitudes.index') }}">
                            <button data-modal-toggle="defaultModal" type="button" class="close">Volver</button>
                        </a>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
    <div class="paginate">
        {{ $detalles }}
    </div>

</x-layouts.menus>
