<x-layouts.menus url="../../css/tienda.css">
    <div class="carga-video">
        <div class="titulo">
            <h3>Store de Articulos</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Costo</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tienda as $articulo)
                    <tr>
                        <td class="filas-tabla">
                            <img class="imgMuestra" src="/storage/{{ $articulo->ruta }}"alt="{{ $articulo->nombre }}">
                        </td>
                        <td class="filas-tabla">
                            {{ $articulo->nombre }}
                        </td>
                        <td class="filas-tabla">
                            {{ Str::limit($articulo->descripcion, 70) }}
                        </td>
                        <td class="filas-tabla">
                            {{ $articulo->costo }}
                        </td>

                        <td class="filas-tabla">
                            <a href="  {{ route('tienda.edit', $articulo->id) }}">
                                <button type="button" class="btn-modificar">
                                    MODIFICAR
                                </button>
                            </a>
                        </td>

                        <td class="filas-tabla">
                            <div class="btnsub">

                                <form action=" {{ route('tienda.delete', $articulo->id) }}" method="post">
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
            {{ $tienda }}
        </div>
        <div class="divisor">
            <div class="titulo">
                <h3>Carga de Imagenes</h3>
            </div>
        </div>
        <div class="frm-carga">

            <form class="fmdatos" action="{{ route('tienda.store') }}" enctype="multipart/form-data" method="post">
                @csrf

                <label for="titulo">Nombre del artículo:</label>
                <input type="text" name="nombre" id="nombre" required value="{{ old('nombre') }}"
                    placeholder="Ingresar nombre">

                <input type="text" name="iden" required id="iden" hidden value="{{ $identificador }}">

                <label for="contenido">Descripcion del artículo</label>
                <textarea name="contenido" id="contenido" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500">{{ old('contenido') }}
                </textarea>

                <label for="costo">Costo del artículo</label>
                <input type="number" name="costo" id="costo" required value="{{ old('costo') }}"
                    placeholder="Ingresar costo">


                <label for="image">Imagen del artículo:</label>
                <input id="image" type="file" name="image">


                <div class="botones">



                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>


                    <a href="{{ route('galeria.index', $identificador) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>

                </div>
            </form>
            @if ($count >= 1)
                <form action="{{ route('galeria.cambio', $identificador) }}" class="formulario" method="post">
                    @method('PUT')
                    @csrf
                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Publicar</button>
                </form>
            @endif

        </div>

    </div>
</x-layouts.menus>
