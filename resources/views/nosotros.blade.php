<x-layouts.principal titulo="Nosotros" url="./css/nosotros.css" js="./js/redondo.js">
    <div class="general">
        <div class="banercabecera">
            <div class="redondo">
                <img src="./img/nosotros/estudioCreativo.png" alt="">
            </div>
            <div class="parrafo">
                <p>...conformado por un equipo multidisciplinario de profesionales expertos en comunicación digital
                    comprometidos en colaborar con las pequeñas y medianas empresas como también con el profesional
                    independiente, para consolidar sus emprendimientos, sus ideas y su presencia en medios digitales..
                </p>
            </div>
        </div>
        <div class="cinta">
            <p>El extraordinario equipo de Glifoo</p>
        </div>




        <div class="personal">
            @php
                $cons = 1;
                $sw = 0;
            @endphp

            @foreach ($fotos as $tar)
                @if ($tar->name != 'Glifoo')
                    @php
                        $sw2 = 0;
                    @endphp
                    @while ($sw2 == 0)
                        @if ($sw == 0)
                            @if ($cons == 1 && $tar->rol == 'Administrador')
                                <div class="setenta">
                                    <x-layouts.setenta cargamento="{{ $tar->rol }}" foto="{{ $tar->foto }}"
                                        fondo="{{ $tar->perfil }}" nombre="{{ $tar->name }}">
                                    </x-layouts.setenta>
                                    @php
                                        $cons++;
                                        $sw2++;
                                    @endphp
                                </div>
                            @else
                                @if ($tar->rol == 'Staff')
                                    <div class="treinta">
                                        <x-layouts.treinta cargamento="" foto="{{ $tar->foto }}"
                                            fondo="{{ $tar->fondo }}" nombre="{{ $tar->name }}">
                                        </x-layouts.treinta>
                                        @php
                                            $cons = 1;
                                            $sw = 1;
                                            $sw2++;
                                        @endphp
                                    </div>
                                @else
                                    <div class="treinta">
                                        <x-layouts.treinta cargamento="" foto="{{ $coleccion->foto }}"
                                            fondo="{{ $coleccion->fondo }}" nombre="">
                                        </x-layouts.treinta>
                                        @php
                                            $cons = 1;
                                            $sw++;
                                        @endphp
                                    </div>
                                @endif
                            @endif
                        @else
                            @if ($cons == 1 && $tar->rol == 'Administrador')
                                <div class="treinta">
                                    <x-layouts.treinta cargamento="" foto="{{ $coleccion->foto }}"
                                        fondo="{{ $coleccion->fondo }}" nombre="">
                                    </x-layouts.treinta>
                                    @php
                                        $cons++;
                                    @endphp
                                </div>
                            @else
                                @if ($tar->rol == 'Administrador')
                                    <div class="setenta">
                                        <x-layouts.setenta cargamento="{{ $tar->rol }}" foto="{{ $tar->foto }}"
                                            fondo="{{ $tar->perfil }}" nombre="{{ $tar->name }}">
                                        </x-layouts.setenta>
                                    </div>
                                    @php
                                        $cons = 1;
                                        $sw2++;
                                        $sw = 0;
                                    @endphp
                                @else
                                    <div class="treinta">
                                        <x-layouts.treinta cargamento="" foto="{{ $tar->foto }}"
                                            fondo="{{ $tar->fondo }}" nombre="{{ $tar->name }}">
                                        </x-layouts.treinta>
                                        @php
                                            $cons = 1;
                                            $sw2 = 1;
                                        @endphp
                                    </div>
                                @endif
                            @endif
                        @endif
                    @endwhile
                @endif

            @endforeach
        </div>
        <div class="cinta">
            <p>Nuestros clientes</p>
        </div>
        <div class="clientes">
            @foreach ($logo as $log)
                <div class="logoClientes">
                    <img src="/storage/{{ $log->logo_url }}" alt="">
                </div>
            @endforeach




        </div>
    </div>
</x-layouts.principal>
