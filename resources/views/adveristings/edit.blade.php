<x-layouts.menus url="../../css/nuevoUsuario.css" >

    <div class="titulo">
        <h3>Editar datos de cliente</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>
    <div class="formulario">
        
        <form class="fmdatos" method="post" action="{{ route('adveristings.update', $publi->id) }}">

            @csrf
            @method('PUT')           

            <label for="">Nombre: </label>
            <input type="text" name="nombre" id="nombre" required value="{{ $publi->nombre}}">

            <label for="concepto">Descripcion</label>
            <textarea name="descripcion" id="descripcion " rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500">{{ $publi->descripcion }}</textarea>

                              

            <div class="botones">
                <button  class="crear">Guardar</button>
                <a href="{{ route('adveristings') }}">
                    <button type="button" class="close">Regresar</button>
                </a>
            </div>
        </form>

    </div>

    </div>
</x-layouts.menus>