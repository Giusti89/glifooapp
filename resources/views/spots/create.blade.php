<x-layouts.menus url="../../css/spotcreate.css">
    <div class="titulo">
        <h3>Crear Spot</h3>
    </div>
   

    <div class="formulario">
       
        <form class="fmdatos" method="post"  action={{ route('spot.store') }} enctype="multipart/form-data">
            @csrf
            
            <textarea id="contenido" rows="4" cols="50" readonly >{{ old('detalle') }}</textarea>

            <label for="">Cliente:</label>
            <div class="selectores">
                <select id="cliente" name="cliente" class="selector">
                    <option value=""></option>
                    @foreach ($clientes as $nombre => $id)
                        <option {{old("cliente","")==$id ? "selected" : ""}} value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
        
            <label for="">Tipo de Publicidad:</label>
            <div class="selectores">
                <select id="publicidad" name="publicidad" class="selector">
                    <option value=""></option>
                    @foreach ($publi as $publicidad)
                        <option {{ old('publicidad') == $publicidad->id ? "selected" : "" }} value="{{ $publicidad->id }}">{{ $publicidad->nombre }}</option>
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
<script>
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
</script>