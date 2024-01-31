<x-app-layout>
    <link rel="stylesheet" href="./css/cservicios.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Servicios') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <x-layouts.butonCrear contenido="Crear Servicio" enlace="{{ route('cservicios.nuevo') }}">
                    </x-layouts.butonCrear>
                                    
                </div>
                <!-- Fin Modal content -->
                <form action="" method="post">
                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Leyenda</th>
                                    <th>Avatar</th>
                                    <th>Modificación</th>
                                    <th>verificar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servicio as $serv)
                                    <tr>
                                        <td class="filas-tabla">
                                            @if ($serv->image_url)
                                                <img class="imgMuestra" src="/storage/{{ $serv->image_url }}"alt="">
                                            @else
                                                {{ $serv->id }}
                                            @endif
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $serv->nombre }}
                                        </td>
                                        <td class="filas-tabla" id="descripcion">
                                            {{ $serv->descripcion }}
                                        </td>
                                        <td class="filas-tabla">
                                            {{ $serv->leyenda }}
                                        </td>
                                        <td class="filas-tabla">
                                            @if ($serv->avatar)
                                                <img class="imgMuestraAvatar" src="/storage/{{ $serv->avatar }}"alt="">
                                            @else
                                                {{ $serv->id }}
                                            @endif
                                        </td>
                                        <td class="filas-tabla">
                                            <a href="{{ route('cservicios.edit', $serv->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    MODIFICAR
                                                </button>
                                            </a>
                                        </td>
                                        <td class="filas-tabla">
                                            <a href="{{ route('mostrarprod', $serv->id) }}">
                                                <button type="button" class="btn-modificar">
                                                    PRODUCTOS
                                                </button>
                                            </a>
                                        </td>
                                        <td class="filas-tabla">
                                            <a href="{{ route('cservicios.delete', $serv->id) }}">
                                                <button class="btn-eliminar" type="button">

                                                </button>
                                            </a>
                                        </td>


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="paginate">
                    {{ $servicio }}
                </div>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>
