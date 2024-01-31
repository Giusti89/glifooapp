<x-layouts.menus url="../../css/nreglaspubli.css">
    <div class="titulo">
        <h3>Nueva regla de publicidad</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">

        <form class="fmdatos" action={{ route('adveristings.store') }} method="post" enctype="multipart/form-data">
            @csrf
            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="{{old("nombre")}}" placeholder="Ingresar nombre">

            <label for="">Descripcion</label>
            <textarea name="descripcion" id="descripcion" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500">{{old("descripcion")}}</textarea>

            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">guardar</button>
                <a href="adveristings.index">
                    <button data-modal-toggle="defaultModal" type="button" class="close">Cancelar</button>
                </a>
            </div>
        </form>

    </div>

</x-layouts.menus>