<x-layouts.menus url="../../css/nuevosubProducto.css">
    <div class="titulo">
        <div class="titulo">
            @if ($subproductos->isNotEmpty() && $subproductos->first()->producto)
                Subproductos del área de: {{ $subproductos->first()->producto->nombre }}
            @else
                No hay productos en este Servicio
            @endif
        </div>

    </div>
    <div class="formulario">
        <div class="table-container">
            <a href="{{ route('nsproducto', $idprod) }}">
                <button data-modal-toggle="defaultModal" type="button" id="myBtn2" class="editar">Nuevo subproducto
                </button>
            </a>        
            <table>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Costo $us</th>                        
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subproductos as $dat)
                        <tr>
                            <td class="filas-tabla">
                                {{ $dat->codigo }}
                            </td>
                            <td class="filas-tabla">
                                {{ $dat->nombre }}
                            </td>
                            <td class="filas-tabla">
                                {{ $dat->costo }}
                            </td>                            
                            <td class="filas-tabla">                                                      
                                <form action="{{ route('eliminarsprod', $dat->id) }} " method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="borrar">                                        
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>        
        <div class="botones">
            <a href="{{ route('mostrarprod',Session::get('idservicio')) }}">
                <button type="button" class="close">Regresar</button>
            </a>
        </div>


    </div>
    <div class="paginate">
        {{ $subproductos }}
    </div>
</x-layouts.menus>
