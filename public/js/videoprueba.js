function accionPlay() {
    if (!medio.paused && !medio.ended) {
        medio.pause();
        play.value = ""; //\u25BA
        // document.body.style.backgroundColor = '#fff';
    } else {
        medio.play();
        play.value = "||";
    }
}

function accionSilenciar() {
    if (screen.width > 600) {
        if (medio.muted) {
            medio.muted = false;

        } else {
            medio.muted = true;

        }
    } else {
        if (medio.muted) {
            medio.muted = false;

        } else {
            medio.muted = true;

        }
    }

}

function iniciar() {
    medio = document.getElementById("medio");
    play = document.getElementById("play");

    retrasar = document.getElementById("retrasar");
    adelantar = document.getElementById("adelantar");
    silenciar = document.getElementById("silenciar");

    play.addEventListener("click", accionSilenciar);
    medio.addEventListener("click", accionSilenciar);

}

window.addEventListener("load", iniciar, false);