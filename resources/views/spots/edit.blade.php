<x-layouts.menus url="../../css/spotcreate.css">
    <div class="titulo">
        <h3>Editar Spot</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">
        <form class="fmdatos" action={{ route('publicidad.update', $publicidad->id) }} method="post"   enctype="multipart/form-data">
            @method('PUT')  
            @csrf

            <label for="">Imagen Actual:</label>
            <img class="max-w-xs h-suto" src="/storage/{{ $publicidad->boton }}"alt="">
                  
            <label for="">Tipo de Publicidad:</label>
            <div class="selectores">
                <select id="publicidad" name="publicidad" class="selector">
                    <option value=""></option>
                    @foreach ($publi as $ad)
                    <option value="{{ $ad->id }}" {{ ($advertisingId == $ad->id) ? 'selected' : '' }}>
                        {{ $ad->nombre }}
                    </option>
                @endforeach
                </select>
            </div>

            <label for="">Boton del spot:</label>
            <input id="file_input" type="file" name="image" accept="image/jpeg/png/webp">
        
            
        
            
            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                <a href="{{ route('publicidad.index') }}">
                    <button data-modal-toggle="defaultModal" type="button" class="close">Cancelar</button>
                </a>
            </div>
        </form>

    </div>

</x-layouts.menus>
{{-- <script>
    var selectPublicidad = document.getElementById('publicidad');
    var textareaContenido = document.getElementById('contenido');

    selectPublicidad.addEventListener('change', function() {
        var publicidadSeleccionada = selectPublicidad.value;

        // Encuentra la publicidad correspondiente en la lista
        var publicidad = @json($publi->keyBy('id'));

        // Actualiza el contenido del textarea según la opción seleccionada
        if (publicidadSeleccionada in publicidad) {
            textareaContenido.value = publicidad[publicidadSeleccionada].descripcion;
            textareaContenido.style.display = "block";
        } else {
            textareaContenido.value = '';
            textareaContenido.style.display = "none";
        }
    });
</script> --}}