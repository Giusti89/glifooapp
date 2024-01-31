<x-layouts.menus url="../../css/modificarU.css">

    <div>
        <form class="frmusuarios" action="{{ route('modify', $miembro->id) }}" method="POST"enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="datos">
                {{-- imagen --}}
                <label class="subtitulos" for="">Reverso del perfil:</label>
                <img class="cuadros" src="/storage/{{ $miembro->foto }}"alt="">
                {{-- fondo --}}
                <label class="subtitulos" for="">Frontis del perfil:</label>
                <img class="cuadros" src="/storage/{{ $miembro->perfil }}"alt="">
                {{-- nombre --}}
                <label class="subtitulos" for="">Datos personales:</label>
                <input class="entrada" type="text" name="nombre" id="nombre" placeholder="{{ $miembro->name }}">
                {{-- email --}}
                <label class="subtitulos" for="">Email:</label>
                <input class="entrada" type="text" name="email" id="email" placeholder="{{ $miembro->email }}">
                {{-- password --}}
                <label class="subtitulos" for="">Pasword:</label>
                <input class="entrada" type="password" name="password" id="password" placeholder="ingrese el nuevo password">
                {{-- servicio --}}
                <label class="subtitulos" for="">Servicio:</label>
                <label for="">{{ $miembro->servicio }}</label>
                <div class="selectores">
                    <select id="servicio_id" name="servicio_id" class="selector">
                        <option value=""></option>
                        @foreach ($servicio as $nombre => $id)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- cargo --}}
                <label class="subtitulos" for="">Cargo:</label>
                <label for="">{{ $miembro->cargo }}</label>
                <div class="selectores">
                    <select id="cargo" name="cargo" class="selector">
                        <option value=""></option>
                        @foreach ($cargo as $nombre => $id)
                            <option value="{{ $id }}">{{ $nombre }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- foto imagen --}}
                <div>
                    <x-input-label class="subtitulos" for="photo" :value="__('Reverso del perfil')" />
                    <input id="file_input" type="file" name="photo">

                </div>
                {{-- fondo imagen --}}

                <div>
                    <x-input-label class="subtitulos" for="backgon" :value="__('Cambiar frontis del perfil')" />
                    <input id="file_input" type="file" name="backgon">

                </div>
            </div>

            <div class="botoness">
                <button  class="editar">Modificar</button>
                <a href="{{ route('dashboard') }}">
                    <button d class="close">Regresar</button>
                </a>
            </div>
        </form>
       



    </div>

</x-layouts.menus>
