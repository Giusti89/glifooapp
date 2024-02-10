<x-layouts.menus url="../../css/redesindex.css">
    <div class="carga-video">        
            <div class="titulo">
                <h3>Carga de redes sociales</h3>
            </div>        
        <div class="frm-carga">
            <form class="fmdatos" action="{{ route('redes.update', $reed->id) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf

                <label for="">Imagen Actual:</label>
                <img class="max-w-xs h-suto" src="/storage/{{ $reed->imagen }}"alt="">

                <input type="text" name="iden" id="iden" hidden value="{{ $reed->id }}">

                <label for="titulo">Nombre red social:</label>
                <input type="text" name="nombre" id="nombre" required value="{{ $reed->nombre }}" >

                <label for="titulo">Enlace red social:</label>
                <input type="text" name="url" id="url" required value="{{ $reed->link}}">

                <label for="">Boton de la red social:</label>
                <input id="image" type="file" name="image" accept="image/jpeg/png/webp/svg">


                <div class="botones">
                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                   
                    <a href=" {{ route('redes.index', $reed->spot_id) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>      
    </div>
</x-layouts.menus>
