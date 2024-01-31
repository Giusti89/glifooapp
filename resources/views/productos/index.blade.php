<x-layouts.menus url="../../css/indxprod.css">

    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="titulo">
        @if ($resultado->isNotEmpty() && $resultado->first()->servicio)
            Productos del área de: {{ $resultado->first()->servicio->nombre }}
        @else
            No hay productos en este Servicio
        @endif
    </div>
    <div class="btnNprod">
        <a href="{{ route('nproducto', $idserv) }}">
            <button data-modal-toggle="defaultModal" type="button" class="editar">Crear
                Producto
            </button>
        </a>
    </div>
    <div class="formulario">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Sub Productos</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($resultado as $dat)
                        <tr>
                            <td class="filas-tabla">
                                {{ $dat->codigo }}
                            </td>
                            <td class="filas-tabla">
                                {{ $dat->nombre }}
                            </td>
                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <a href="{{ route('subproductos', $dat->id) }}">
                                        <button data-modal-toggle="defaultModal" type="button" class="editar">
                                            Sub productos
                                        </button>
                                    </a>
                                </div>
                            </td>
                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <form action="{{ route('eliminarprod', $dat->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="borrar" type="submit">
                                            
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="botones">
            <a href="{{ route('cservicios.store') }}">
                <button type="button" class="close">Regresar</button>
            </a>
        </div>
    </div>
    <div class="paginate">
        {{ $resultado }}
    </div>
</x-layouts.menus>
