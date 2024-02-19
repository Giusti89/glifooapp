<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/pubsinmap.css">

    <link rel="icon" href="{{ asset('storage/' . $logoCliente ?? '') }}">

    <title>{{ $titulo ?? '' }}</title>
</head>

<body>
    <div class="contPrincipal">
        <div class="banerPrincipal">
            <img src="{{ asset('storage/' . $imagenPrincipal ?? '') }}" alt="{{ $titulo ?? '' }}">
        </div>
        <div class="art">
            <div class="descrip">
                @foreach ($images as $im)
                    <img src="{{ asset('storage/' . $im->ruta) }}" alt="">
                @endforeach
            </div>
            <div class="redes">
                <div class="empr">
                    <h1>{{ $tituloArticulo ?? '' }}</h1>
                    <p>{{ $textoArticulo ?? '' }}</p>
                </div>
                <div class="social">
                    <div class="conteBotones">
                        @foreach ($redes as $red)
                            <div class="boton">
                                <a href="{{ $red->link }}" target="_blank">
                                    <img src="{{ asset('storage/' . $red->imagen) }}" alt="{{ $red->nombre }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="rectangulo">

                    </div>
                </div>

            </div>

        </div>
        <div class="repro">
            <video autoplay="false" controls>
                <source src="{{ asset('storage/' . $videoPrincipal ?? '') }}" type="video/mp4" />
            </video>

        </div>


    </div>

</body>

</html>
