<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <title>Glifoo - {{$titulo}}</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./img/logos/Boton.ico">

    <link rel="stylesheet" href="{{ $url ?? '' }}">

    <!-- Google tag (gtag.js) -->
    {{-- <script async src="https://www.googletagmanager.com/gtag/js?id=G-V2K5HHNLS2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-V2K5HHNLS2');
    </script> --}}
    <!-- Google tag (gtag.js) -->

</head>

<body>

    <header class="main-header">
        <a class="main-logo" href="{{ route('inicio') }}">
            <img src="./img/logos/GlifooComunicacion.png" alt="">
        </a>
        <nav id="nav" class="main-nav">
            <div class="nav-links">
                @auth
                    <a class="link-item" href="{{ route('dashboard') }}">Administrar</a>
                @endauth
                <a class="link-item" href="{{ route('inicio') }}">Inicio</a>
                <a class="link-item" href="{{ route('servicios') }}">Servicios</a>
                <a class="link-item" href="{{ route('nosotros') }}">Nosotros</a>
                <a class="link-item" href="{{ route('contactos') }}">Contacto</a>
                <a class="link-item" href="{{route('publicidad')}}">Publicidad</a>
                <a class="link-item" href="https://glifoo.org/">Blog</a>
            </div>
        </nav>
        <button id="button-menu" class="button-menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>
    {{ $slot }}
    <div class="aviso-cookies" id="aviso-cookies">
        <img class="galleta" src="./img/logos/Boton.webp" alt="Galleta">
        <h3 class="titulo">Cookies</h3>
        <p class="parrafo">Utilizamos cookies propias y de terceros para mejorar nuestros servicios.</p>
        <button class="boton" id="btnCokies">De acuerdo</button>
    </div>
    <div class="fondo-aviso-cookies" id="fondo-aviso-cookies"></div>
    <footer>
        <div class="pie">
            <div class="caja">
                <a href="{{ route('inicio') }}"><img src="./img/logos/LogoGlifoo.png" alt=""></a>
            </div>
            <div class="caja">
                <a href="https://api.whatsapp.com/message/CYAKMDYVY2D3F1?autoload=1&app_absent=0" target="_blank"
                    rel="noopener"><img src="./img/logos/Whatsapp.png" alt=""></a>
                <a href="https://www.tiktok.com/@glifoo?lang=es" target="_blank" rel="noopener"><img
                        src="./img/logos/TikTok.png" alt=""></a>
                <a href="https://twitter.com/Glifoo_cc" target="_blank" rel="noopener"> <img
                        src="./img/logos/Twitter.png" alt=""></a>
                <a href="https://www.youtube.com/channel/UCRETsH6tXdRtO5z0yo0fYAw" target="_blank" rel="noopener"><img
                        src="./img/logos/Youtube.png" alt=""></a>
                <a href="https://www.instagram.com/glifoo.cc/" target="_blank" rel="noopener"><img
                        src="./img/logos/Instagram.png" alt=""></a>
                <a href="https://www.facebook.com/glifoo" target="_blank" rel="noopener"><img
                        src="./img/logos/Facebook.png" alt=""></a>
            </div>
        </div>
    </footer>
    <div class="final">
        <div class="copy">
            <a href="{{ route('inicio') }}">
                <p>©2023 Glifoo - Comunicación Digital</p>
            </a>
            <div>
                <a href="{{ route('privacidad') }}">Políticas de privacidad</a>
            </div>
        </div>
    </div>

    <script src="./js/avisoCokies.js"></script>
    <script src="./js/index.js"></script>
    <script src="{{ $js ?? '' }}"></script>
    {{-- <script src="https://cdn.pulse.is/livechat/loader.js" data-live-chat-id="64e7c8443cb253aff305f1e1" async></script>
    <script src="undefinedloader.js" data-live-chat-id="64e7c8443cb253aff305f1e1" async></script> --}}
</body>

</html>
