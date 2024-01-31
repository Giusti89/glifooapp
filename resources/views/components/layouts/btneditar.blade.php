<link rel="stylesheet" href="../../css/btnmodif.css">
<div class="btnsub">
    <a href="{{ route('{{$ruta }}', {{$dato }}) }}">
        <button data-modal-toggle="defaultModal" type="button" class="editar">
       {{$texto}}
        </button>
    </a>
</div>