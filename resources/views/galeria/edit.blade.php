<x-layouts.menus url="../../css/redesindex.css">
    <div class="carga-video">        
            <div class="titulo">
                <h3>Editar imagen</h3>
            </div>        
        <div class="frm-carga">
            
            <form class="fmdatos" action="{{ route('galeria.update', $imgg->id) }}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf

                <label for="">Imagen Actual:</label>
                <img class="max-w-xs h-suto" src="/storage/{{ $imgg->ruta }}"alt="">

                <label for="">Tipo de Prioridad:</label>
                <div class="selectores">
                    <select id="prioridad" name="prioridad" class="selector">
                        <option value=""></option>
                        @foreach ($prio as $ad)
                        <option value="{{ $ad->id }}" {{ ($spot_id == $ad->id) ? 'selected' : '' }}>
                            {{ $ad->nombre }}
                        </option>
                    @endforeach
                    </select>
                </div>               

                <label for="">Boton de la red social:</label>
                <input id="image" type="file" name="image" accept="image/jpeg/png/webp/svg">


                <div class="botones">
                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                    
                    <a href="{{ route('galeria.index', $imgg->spot_id) }} ">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>      
    </div>
</x-layouts.menus>