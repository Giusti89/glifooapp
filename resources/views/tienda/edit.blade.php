<x-layouts.menus url="../../css/redesindex.css">
    <div class="carga-video">
        <div class="titulo">
            <h3>Redes sociales</h3>
        </div>
        <div class="frm-carga">
           
            <form class="fmdatos" action=" {{ route('tienda.update', $tienda->id) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf

                <label for="">Imagen actual del Articulo :</label>
                <img class="max-w-xs h-suto" src="/storage/{{ $tienda->ruta }}"alt="">

                <input type="text" name="iden" id="iden" hidden value="{{ $tienda->id }}">

                <label for="titulo">Nombre red social:</label>
                <input type="text" name="nombre" id="nombre" required value="{{ $tienda->nombre }}">

                <label for="">Descripción:</label>
                <textarea name="descripcion" id="descripcion" cols="40" rows="15">{{ $tienda->descripcion }}</textarea>

                <label for="titulo">Costo del articulo:</label>
                <input type="number" name="costo" id="costo" required value="{{ $tienda->costo }}">

                <label for="">Imagen del articulo:</label>
                <input id="image" type="file" name="image" accept="image/jpeg/png/webp/svg">

                <div class="botones">
                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>

                    <a href=" {{ route('tienda.index', $tienda->spot_id) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.menus>
