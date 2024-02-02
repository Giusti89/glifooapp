<x-layouts.menus url="../../css/modificar.css">
    <div class="titulo">
        <h3>Realice las modificaciones pertinentes</h3>
    </div>
    <div class="formulario">

        <form class="fmdatos" action="{{ route('cservicios.update', $muestra->id) }}" method="post"
            enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <label for="">Imagen:</label>
            <img class="max-w-xs h-suto" src="/storage/{{ $muestra->image_url }}"alt="">

            <label for="">Avatar:</label>
            <img class="max-w-xs h-suto" src="/storage/{{ $muestra->avatar }}"alt="">


            <input name="imagenAnterior" id="imagenAnterior" value="{{ $muestra->image_url }}" type="hidden">


            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="{{ $muestra->nombre }}">

            <label for="">Leyenda:</label>
            <input type="text" name="leyenda" id="leyenda" required value="{{ $muestra->leyenda }}">

            <label for="">Descripcion:</label>
            <textarea name="descripcion" id="descripcion" cols="40" rows="15">{{ $muestra->descripcion }}</textarea>

            <label for="">Nueva imagen:</label>
            <input id="file_input" type="file" name="image">

            <label for="">Nuevo avatar:</label>
            <input id="file_input" type="file" name="avatar">

            <div class="botones">
                <button   class="editar">Modificar</button>
                <a href="{{ route('cservicios.store') }}">
                    <button   class="close">Regresar</button>
                </a>
            </div>
        </form>
    </div>
    </div>
</x-layouts.menus>
