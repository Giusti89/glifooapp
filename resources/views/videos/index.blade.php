<x-layouts.menus url="../../css/videos.css">
    <div class="carga-video">
        <div class="titulo">
            <h3>Visor de Videos actuales</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Archivo</th>

                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($videos as $video)
                    <tr>
                        <td class="filas-tabla">
                            <div class="repro">
                                <video autoplay="false" controls>
                                    <source src="{{ asset('storage/' . $video->ruta) }}" type="video/mp4" />
                                </video>
                            </div>
                        </td>


                        <td class="filas-tabla">

                            <a href="{{ route('video.edit', $video->id) }}">
                                <button type="button" class="btn-modificar">
                                    MODIFICAR
                                </button>
                            </a>
                        </td>

                        <td class="filas-tabla">
                            <div class="btnsub">

                                <form action="{{ route('video.delete', $video->id) }}" method="post">
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
        <div class="divisor">
            <div class="titulo">
                <h3>Carga de Video</h3>
            </div>
        </div>
        <div class="frm-carga">

            <form class="fmdatos" action="{{ route('video.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <input type="text" name="iden" required id="iden" hidden value="{{ $identificador }}">


                <label for="image">Video de la pagina:</label>
                <input id="image" type="file" name="image">


                <div class="botones">
                    @if ($count > 0)
                        <a href="{{ route('galeria.index', $identificador) }}">
                            <button data-modal-toggle="defaultModal" type="button" class="crear">Siguiente</button>
                        </a>
                    @else
                        <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                    @endif

                    <a href="{{ route('redes.index', $identificador) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>

    </div>
</x-layouts.menus>
