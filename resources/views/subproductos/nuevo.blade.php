<x-layouts.menus url="../../css/nsproducto.css">
    <div class="titulo">
        <h3>Nuevo Subproducto</h3>
    </div>

    <div class="conterrores">
        @include('fragments._errors-form')
    </div>
    
    <div class="formulario">

        <form class="fmdatos" action={{ route('sstore') }} method="post">
            @csrf

            <label for="">Codigo:</label>
            <input type="text" name="codigo" id="codigo" required value="{{old("codigo")}}" placeholder="Ingresar el codigo">

            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="{{old("nombre")}}" placeholder="Ingresar el nombre">

            <label for="">Costo:</label>
            <input type="text" name="costo" id="costo" required value="{{old("costo")}}" placeholder="Ingresar el costo">



            <input type="text" name="producto" id="producto" hidden required value={{ $id }}>




            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">guardar</button>
                <a href="{{ route('subproductos', $id) }}">
                    <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                </a>
            </div>
        </form>
    </div>

</x-layouts.menus>
