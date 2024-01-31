<x-layouts.menus url="../../css/nuevasol.css">
    <div class="titulo">
        <h3>Nueva solicitud</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">
       
        <form class="fmdatos" action={{ route('completado') }}  method="post">
            @csrf
            <label for="">Cliente:</label>
            <div class="selectores">
                <select id="cliente_id" name="cliente_id" class="selector">
                    <option value=""></option>
                    @foreach ($clientes as $nombre => $id)
                        <option {{old("cliente_id","")==$id ? "selected" : ""}} value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <label for="">Servicio:</label>
            <div class="selectores">
                <select id="servicio_id" name="servicio_id" class="selector">
                    <option value=""></option>
                    @foreach ($servicio as $nombre => $id)
                        <option {{old("servicio_id","")==$id ? "selected" : ""}} value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <label for="">Concepto</label>
            <textarea name="concepto" id="concepto" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500">{{old("concepto")}}</textarea>

            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">guardar</button>
                <a href="solicitudes">
                    <button data-modal-toggle="defaultModal" type="button" class="cerrar">Cancelar</button>
                </a>
            </div>
        </form>

    </div>


</x-layouts.menus>
