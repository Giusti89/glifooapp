<x-layouts.principal titulo="Servicios" url="./css/servicio.css">
    <div class="encabezado">
        <p>
            ¿Necesitas diferenciarte e impresionar con tu marca o emprendimiento?
        </p>

        <div class="banner">
            <div class="redondo">
                <img src="./img/servicios/vistazo.webp" alt="vistazo">
            </div>
        </div>

    </div>
    {{-- tarjetassss --}}

    <div class="tarjetero">
        @foreach ($tarjetas as $tar)
            <div class="flip-container">
                <div class="card">

                    <div class="front" style="background-image: url(/storage/{{ $tar->image_url }})">
                        <div class="contenedor">
                            <p>{{ $tar->leyenda }}</p>
                        </div>
                        <div class="area">
                            {{ $tar->nombre }}
                        </div>

                    </div>

                    <div class="back">
                        <div class="conte">
                            <p> {{ $tar->descripcion }}</p>
                        </div>
                        <div class="btnver">
                            <a href="#"><button>Saber Más</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>    
    {{-- tarjetassss --}}

    <div class="portfolios">
        <div class="portafolio">
            <a href="{{route('portfolio')}}"><button>PORTFOLIO</button></a>
        </div>
        <div class="informaciones">
            <a href="#"><button> MÁS INFORMACIÓN</button></a>
        </div>

    </div>


</x-layouts.principal>
