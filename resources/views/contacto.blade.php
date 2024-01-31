<x-layouts.principal titulo="Contacto" url="./css/contacto.css">
    <div>
        @if (session('info'))
            <script>
                alert("{{ session('info') }}");
            </script>
        @endif
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>
    <div class="banerPrincipal">
        <p>Escríbenos</p>
    </div>
    <div class="mensaje">
        <p>Si necesita mas información con respecto a nuestros servicios, comunicate con nosotros, estaremos muy
            contentos de atenderte</p>
    </div>
    <div class="encabezado">
        <h1>Contacto</h1>
    </div>

    

    <div class="formulario">
        <div class="envio">
            <form action="{{ Route('contacto.store') }}" method="post">
                @csrf
                <div class="nome">
                    <input type="text" id="txt_nombre" name="txt_nombre" placeholder=" Nombre*" required value="{{old("txt_nombre")}}">
                    <input type="email" id="txt_mail" name="txt_mail" placeholder="Email*" value="{{old("txt_mail")}}">
                    <input type=" text" id="txt_Asunto" name="txt_asunto" placeholder="Asunto*"required value="{{old("txt_asunto")}}">
                    <input type=" text" id="txt_telefono" name="txt_wap" placeholder="Whatsapp" required value="{{old("txt_wap")}}">
                    <textarea type=" text" id="txt_mensaje" name="txt_mensaje" cols="30" rows="10" placeholder="  Mensaje"
                        required>{{old("txt_mensaje")}}</textarea>
                    <div id="verificacion">
                        <input type="checkbox" id="check">
                        <label for="check">He leído y acepto el a<b> aviso legal</b> y <b> política de
                                privacidad</b></label>
                        <button type="submit" id="boton" name="botonEnvio">ENVIAR</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="context">
        <button class="port" onclick="window.location.href='contacto'">
            <img src="./img/logos/correo.png" alt="">
            Email: info@glifoo.com
        </button>
        <button class="info"
            onclick="window.location.href='https://api.whatsapp.com/message/CYAKMDYVY2D3F1?autoload=1&app_absent=0'">
            <img src="./img/logos/Whatsapp.png" alt="watsap">
            +591 60639377
        </button>
    </div>
</x-layouts.principal>
