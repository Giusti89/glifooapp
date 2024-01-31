<div class="mapouter">
    <div class="gmap_canvas">
        <iframe width="820" height="560" id="gmap_canvas"
            src="{{ $mapa ?? '' }}"
            
            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        <a href="https://online-timer.me/">
        </a>
        <br>
        <a href="https://online.stopwatch-timer.net/"></a>
        <br>
        <style>
            .mapouter {
                display: flex;
                justify-content: center;
                align-items: center;
                text-align: right;
                height: auto;
                width: 70vw;
                margin-bottom: 15px;
            }
        </style>
        <a href="https://www.embedmaps.co">google map for my website</a>
        <style>
            .gmap_canvas {
                overflow: hidden;
                background: none !important;
                height: 560px;
                width: 820px;
            }
        </style>
    </div>
</div>