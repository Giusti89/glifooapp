<x-layouts.menus url="../../css/redesindex.css">
    <div class="carga-video">
        <div class="titulo">
            <h3>Visor de redes actuales</h3>
        </div>
        <div class="visualizar">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Enlace</th>
                        <th>Imagen</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publi as $pub)
                        <tr>
                            <td class="filas-tabla">
                                {{ $pub->nombre }}
                            </td>
                            <td class="filas-tabla">
                                {{ $pub->link }}
                            </td>
                            <td class="filas-tabla" id="descripcion">
                                <img class="imgMuestra" src="/storage/{{ $pub->imagen }}"alt="">
                            </td>
                            <td class="filas-tabla">

                                <a href="{{ route('redes.edit', $pub->id) }}">
                                    <button type="button" class="btn-modificar">
                                        MODIFICAR
                                    </button>
                                </a>
                            </td>

                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <form action="{{ route('redes.delete', $pub->id) }}" method="post">
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
                {{ $publi }}
            </div>
        </div>
        <div class="divisor">
            <div class="titulo">
                <h3>Carga de redes sociales</h3>
            </div>
        </div>
        <div class="frm-carga">
            <form class="fmdatos" action="{{ route('redes.store') }}" enctype="multipart/form-data" method="post">
                @csrf
                <input type="text" name="iden" id="iden" hidden value="{{ $identificador }}">

                <label for="titulo">Nombre red social:</label>
                <input type="text" name="nombre" id="nombre" required value="{{ old('nombre') }}"
                    placeholder="Ingresar nombre">

                <label for="titulo">Enlace red social:</label>
                <input type="text" name="url" id="url" required value="{{ old('url') }}"
                    placeholder="Ingresar enlace">

                <label for="">Boton de la red social:</label>
                <input id="image" type="file" name="image" accept="image/jpeg/png/webp/svg">


                <div class="botones">
                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                    <a href="{{ route('storepub', $identificador) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
        @if ($count > 0)
            <div class="siguiente">
                <a href="{{ route('video.index', $identificador) }}">
                    <button data-modal-toggle="defaultModal" type="button" class="crear">Siguiente</button>
                </a>
            </div>
        @endif
    </div>
</x-layouts.menus>
