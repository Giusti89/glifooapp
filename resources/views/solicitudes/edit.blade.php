<x-layouts.menus url="../../css/nuevasol.css">
    <div class="titulo">
        <h3>Nueva solicitud</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>

    <div class="formulario">

        <form class="fmdatos" action={{ route('actualizarsolicitud', $solicitud->id) }} method="post">
            @method('PUT')
            @csrf

            <label for="cliente_id">Cliente:</label>
            <div class="selectores">
                <select id="cliente_id" name="cliente_id" class="selector" readonly >
                    <option value=""></option>
                    @foreach ($cliente as $nombre => $id)
                        <option value="{{ $id }}" {{ ($clienteId == $id) ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <label for="servicio_id">Servicio:</label>
            <div class="selectores">
                <select id="servicio_id" name="servicio_id" class="selector">
                    <option value=""></option>
                    @foreach ($servicio as $nombre => $id)
                        <option value="{{ $id }}" {{ $servicioId == $id ? 'selected' : '' }}>
                            {{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            <label for="concepto">Concepto</label>
            <textarea name="concepto" id="concepto" rows="4"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500">{{ $solicitud->concepto }}</textarea>

            <div class="botones">
                <button data-modal-toggle="defaultModal" type="submit" class="crear">Guardar</button>
                <a href="{{ route('solicitudes.index') }}">
                    <button data-modal-toggle="defaultModal" type="button" class="cerrar">Regresar</button>
                </a>
            </div>
        </form>

    </div>


</x-layouts.menus>
