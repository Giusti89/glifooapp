<link rel="stylesheet" href="./css/corto.css">
<div class="tarjetero">
    <div class="flip-container">
        <div class="card">
            <div class="front" style="background-image: url(/storage/{{ $fondo }})">
                <div class="area">
                    {{ $nombre }} <br>
                    {{ $cargamento }}
                </div>
            </div>
            <div class="back">
                <div class="front" style="background-image: url(/storage/{{ $foto }})">
                    
                </div>
            </div>
        </div>
    </div>
</div>