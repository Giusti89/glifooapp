const placeTar = document.getElementById('conteTar')
let mosTar
let tar = []

class tarjeta {
    constructor(nombre, descripcion, url) {
        this.nombre = nombre
        this.descripcion = descripcion
        this.url = url
    }
}
let mision = new tarjeta(
    'Mision',
    'Nuestra misión en Glifoo - Comunicación Digital es brindar un servicios de la más alta calidad, enfocados en superar las expectativas de nuestros clientes. Trabajamos incansablemente para potenciar la presencia en línea de nuestros socios comerciales, utilizando estrategias innovadoras y creativas que generen un impacto duradero en sus audiencias.',
    './img/index/mision.webp',
)

let vision = new tarjeta(
    'Vision',
    'Nos vemos como líderes en el campo de la comunicación digital, reconocidos por nuestra excelencia en el servicio y la entrega de resultados excepcionales. Buscamos ser la opción preferida de empresas que buscan una transformación digital efectiva y significativa, destacándonos por nuestra ética de trabajo, compromiso y pasión por impulsar el éxito de nuestros clientes.',
    './img/index/vision.webp',
)

let objetivo = new tarjeta(
    'Objetivo',
    'Nuestro principal objetivo es elevar los estándares de la comunicación digital a través de soluciones personalizadas y de alta calidad. Buscamos establecer relaciones sólidas y a largo plazo con nuestros clientes, basadas en la confianza y la entrega constante de resultados excepcionales. Nos esforzamos por crear estrategias y campañas que no solo cumplan con las expectativas, sino que las superen, impulsando el crecimiento y la visibilidad de nuestros socios comerciales.',
    './img/index/objetivo.webp',
)

tar.push(mision, vision, objetivo)

function iniciarVentana() {
    tar.forEach((tarjeta) => {
        mosTar = ` 
    <div class="flip-container">
        <div class="card">
            <div class="front" front" style="background-image: url('${tarjeta.url}')">
                <div class="area">
                    <p>${tarjeta.nombre}</p>
                </div>
            </div>
            <div class="back">
                <P>
                ${tarjeta.descripcion}
                </P>

            </div>
        </div>
    </div>
        `
        placeTar.innerHTML += mosTar
    })
}

window.addEventListener('load', iniciarVentana)