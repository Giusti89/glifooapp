<x-layouts.menus url="../../css/nuevoUsuario.css" >

    <div class="titulo">
        <h3>Editar datos de cliente</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>
    <div class="formulario">
        
        <form class="fmdatos" method="post" enctype="multipart/form-data" action="{{ route('clientes.update', $clie->id) }}">

            @csrf
            @method('PUT')

            <label for="">Imagen:</label>
            <img class="max-w-xs h-suto" src="/storage/{{ $clie->logo_url }}"alt="">

            <label for="">Nombre cliente:</label>
            <input type="text" name="nombre" id="nombre" required value="{{ $clie->nombre}}">

            <label for="">Contacto:</label>
            <input type="number" name="contacto" id="contacto" required value="{{ $clie->contacto }}">

            <label for="">Email:</label>
            <input type="email" name="email" id="email" required value="{{ $clie->email }}">

            <label for="">Direccion:</label>
            <input type="direccion" name="direccion" id="direccion"  value="{{ $clie->direccion }}">

            <label for="">Nueva imagen:</label>
            <input id="file_input" type="file" name="image" accept="image/jpeg/png/webp">                    

            <div class="botones">
                <button  class="crear">guardar</button>
                <a href="clientes">
                    <button  class="close">Cancelar</button>
                </a>
            </div>
        </form>

    </div>

    </div>
</x-layouts.menus>