<x-layouts.menus url="../../css/reglaspubli.css">
    <div class="titulo">
        <h3>Reglas de publicidad</h3>
    </div>
    <div class="conterrores">
        @include('fragments._errors-form')
    </div>
    <div class="btnNprod">
        <x-layouts.butonCrear contenido="Tipo de Publicidad" enlace="adveristings.create">
        </x-layouts.butonCrear>
    </div>
    

    <div class="formulario">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripcion</th>
                        <th>Moificar</th>
                        <th>Eliminar</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reglas as $dat)
                        <tr>
                            <td class="filas-tabla">
                                {{ $dat->nombre }}
                            </td>
                            
                            <td class="filas-tabla">
                                {{ $dat->descripcion }}
                            </td>
                            <td class="filas-tabla">
                                <div class="btnsub">
                                    <a href="{{ route('editarPublicidad', $dat->id) }}">
                                        <button data-modal-toggle="defaultModal" type="button" class="editar">
                                            Modificar
                                        </button>
                                    </a>
                                </div>
                            </td>
                            <td class="filas-tabla">
                                
                                <div class="btnsub">
                                    <form action="{{ route('adveristings.destroy', $dat->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="borrar" type="submit">
                                            
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="botones">
            <a href="{{ route('dashboard') }}">
                <button type="button" class="close">Regresar</button>
            </a>
        </div>
    </div>
    <div class="paginate">
        {{ $reglas }}
    </div>

</x-layouts.menus>