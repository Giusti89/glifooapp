<x-layouts.principal titulo="Servicios" url="./css/publi.css">
    <div class="contenedor">
        <div class="cabz">
            <div class="artz">
                <img src="./img/logos/pulse.png" alt="">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat velit rem nihil voluptatibus ab
                    error nulla adipisci architecto eaque maxime, quisquam harum veritatis optio eum obcaecati quasi
                    esse facere autem. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum dolore, libero
                    possimus ratione delectus animi a quasi illum repudiandae illo minus fugiat voluptate corporis
                    aperiam repellat quaerat officiis in sed?</p>

            </div>
            <div class="vid">

            </div>

        </div>
        <div class="titulo">
            <h2>Nuestros clientes <b>Pulse</b> </h2>
        </div>
        <div class="capa2">
            <div class="fotos">
                @foreach ($boton as $cuadro)
                    @if ($cuadro->estado == 1)
                        <div class="imgpub">
                            <a href="{{ route('publicidad.show', $cuadro->slug) }}">
                                <img class="imgMuestraAvatar" src="/storage/{{ $cuadro->boton }}" alt="">
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="vid2"></div>
        </div>
    </div>
</x-layouts.principal>
