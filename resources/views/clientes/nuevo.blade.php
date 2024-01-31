<x-layouts.menus url="../../css/nuevoUsuario.css" >

    <div class="titulo">
        <h3>Nuevo Cliente</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>
    <div class="formulario">

        <form class="fmdatos" action={{ route('crear') }} method="post" enctype="multipart/form-data">
            @csrf
            <label for="">Nombre cliente:</label>
            <input type="text" name="nombre" id="nombre" required value="{{old("nombre")}}" placeholder="Ingresar nombre">

            <label for="">Contacto:</label>
            <input type="number" name="contacto" id="contacto" required value="{{old("contacto")}}" placeholder="Ingresar contacto">

            <label for="">Email:</label>
            <input type="email" name="email" id="email" required value="{{old("email")}}" placeholder="Ingresar email">

            <label for="">Direccion cliente:</label>
            <input type="text" name="direccion" id="direccion" value="{{old("direccion")}}" placeholder="Ingresar direccion">

            <label for="">Nueva imagen:</label>
            <input id="file_input" type="file" name="image" accept="image/jpeg/png/webp">

            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">guardar</button>
                <a href="clientes">
                    <button data-modal-toggle="defaultModal" type="button" class="close">Cancelar</button>
                </a>
            </div>
        </form>

    </div>

    

</x-layouts.menus>ñ