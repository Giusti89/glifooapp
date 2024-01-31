<x-layouts.menus url="../../css/nuevoProducto.css" >
    <div class="titulo">
        <h3>Nuevo Producto</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">
        @csrf
        
        <form class="fmdatos" action={{ route('creare') }}  method="post">
            @csrf
            <label for="">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required value="{{old("nombre")}}" placeholder="Ingresar nombre">

            <label for="">Codigo:</label>
            <input type="text" name="codigo" id="codigo" required value="{{old("codigo")}}" placeholder="Ingresar codigo" >

            <input type="text" name="producto" id="producto" hidden  required value= {{$producto}}>            

            <div class="botones">
                <button data-modal-toggle="defaultModal"   type="submit" class="crear">guardar</button>
                <a href="{{ route('mostrarprod',$producto) }}">
                    <button data-modal-toggle="defaultModal"   type="button" class="cerrar">Cancelar</button>
                </a>
            </div>
        </form>

    </div>

</x-layouts.menus>