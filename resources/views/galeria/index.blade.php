<x-layouts.menus url="../../css/videos.css">
    <div class="carga-video">
        <div class="titulo">
            <h3>Galeria de imagenes</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Prioridad</th>
                    <th>Imagen</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($imagenes as $im)
                    <tr>
                        <td class="filas-tabla">
                            @if ($im->priority)
                                {{ $im->priority->nombre }}
                            @else
                                Sin prioridad
                            @endif
                        </td>
                        <td class="filas-tabla">
                            <img class="imgMuestra" src="/storage/{{ $im->ruta }}"alt="">
                        </td>


                        <td class="filas-tabla">

                            <a href="{{ route('galeria.edit', $im->id) }}">
                                <button type="button" class="btn-modificar">
                                    MODIFICAR
                                </button>
                            </a>
                        </td>

                        <td class="filas-tabla">
                            <div class="btnsub">
                                <form action="{{ route('galeria.delete', $im->id) }}" method="post">
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
        <div class="paginate">
            {{ $imagenes }}
        </div>
        <div class="divisor">
            <div class="titulo">
                <h3>Carga de Imagenes</h3>
            </div>
        </div>
        <div class="frm-carga">

            <form class="fmdatos" action="{{ route('galeria.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <label for="cliente_id">Prioridad:</label>
                <div class="selectores">
                    <select id="prioridad" name="prioridad" class="selector">
                        <option value=""></option>
                        @foreach ($prio as $id => $nombre)
                            <option value="{{ $id }}" {{ $id == old('prioridad') ? 'selected' : '' }}>
                                {{ $nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <input type="text" name="iden" required id="iden" hidden value="{{ $identificador }}">


                <label for="image">Video de la pagina:</label>
                <input id="image" type="file" name="image">


                <div class="botones">
                    @if ($advertisingNombre != 'Publicidad Store')
                    {{-- {{ route('terminado', $marcador) }} --}}
                        <form action="" class="formulario" method="post">
                            @method('PUT')
                            @csrf
                            
                                <button data-modal-toggle="defaultModal" type="submit" class="crear">Publicar</button>
                            
                        </form>
                        <a href="{{ route('video.index', $identificador) }}">
                            <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                        </a>
                    @else
                        @if ($count >= 5)
                            <a href="{{ route('tienda.index', $identificador) }}">
                                <button data-modal-toggle="defaultModal" type="button"
                                    class="crear">Siguiente</button>
                            </a>
                        @else
                            <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                        @endif

                        <a href="{{ route('video.index', $identificador) }}">
                            <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                        </a>
                    @endif
                </div>
            </form>
        </div>

    </div>
</x-layouts.menus>
