<x-layouts.menus url="../../css/nuevoServicio.css">
    <div class="titulo">
        <h3>Nuevo servicio a implementar</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">

        <form class="fmdatos" action={{ route('cservicios.store') }} method="post"enctype="multipart/form-data">

            @csrf
            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="{{old("nombre",)}}" placeholder="Ingresar nombre">

            <label for="">Leyenda:</label>
            <input type="text" name="leyenda" id="leyenda" required value="{{old("leyenda")}}" placeholder="Ingresar la leyenda">

            <label for="">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500" placeholder="Introducir descripción"></textarea>

            <label for="">Nueva imagen:</label>
            <input id="file_input" type="file" name="image" accept="image/jpeg/png/webp">

            <label for="">Nueva avatar:</label>
            <input id="file_input" type="file" name="avatar" accept="image/jpeg/webp">


            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">guardar</button>
                <a href="{{ route('cservicios.store') }}">
                    <button data-modal-toggle="defaultModal" type="button" class="close">Cancelar</button>
                </a>
            </div>
        </form>

    </div>
    
</x-layouts.menus>


