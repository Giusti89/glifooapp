<x-layouts.menus url="../../css/redesindex.css">
    <div class="carga-video">        
            <div class="titulo">
                <h3>Carga de video sociales</h3>
            </div>        
        <div class="frm-carga">
            
            <form class="fmdatos" action="{{ route('video.update', $vid->id) }}"  enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf

                <label for="">Video Actual:</label>
                <div class="repro">
                    <video autoplay="false" controls>
                        <source src="{{ asset('storage/' . $vid->ruta) }}" type="video/mp4" />
                    </video>
                </div>

                <label for="image">Video de la pagina:</label>
                <input id="image" type="file" name="image">               


                <div class="botones">
                    <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                  
                    <a href=  "{{ route('video.index', $vid->spot_id) }}">
                        <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                    </a>
                </div>
            </form>
        </div>      
    </div>
</x-layouts.menus>