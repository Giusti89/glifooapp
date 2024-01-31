<x-layouts.principal titulo="inicio" url="./css/inicio.css" >
    <?php
    require './Mobile-Detect-3.74.0/src/MobileDetect.php';
    $detect = new \Detection\MobileDetect();
    $deviceType = $detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer';
    ?>

    <div id="contenedor">
        <div id="cajarep">
            <video id="medio" width="100%" autoplay="true" muted loop="true">
                <?php if ($detect->isMobile()) { ?>
                <source src="./videos/videoPortadaMovil.mp4" type="video/mp4" />

                <?php } else { ?>

                <source src="./videos/Video portada.mp4" type="video/mp4" />

                <?php } ?>

            </video>
            <nav id="navegador">
                <input type="button" id="play">
            </nav>


        </div>
    </div>
    <div class="textoDeslizante">
        <marquee behavior="scroll" direction="left">Calidad - Innovación - Compromiso - Integridad - Colaboración -
            Empatía - Responsabilidad - Aprendizaje - Pasión - Impacto Positivo</marquee>
    </div>
    {{-- -------------------cards---------------- --}}


    <div class="contenedorCards" id="conteTar">



    </div>


    <script src="./js/mvo.js"></script>
    <script src="./js/videoprueba.js"></script>
</x-layouts.principal>
