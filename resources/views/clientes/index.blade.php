<x-app-layout>
    <link rel="stylesheet" href="./css/clientes.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">          
                <div class="p-6 text-gray-900">

                    <x-layouts.butonCrear contenido="Nuevo cliente" enlace="{{ route('novo') }}">
                    </x-layouts.butonCrear>

                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Contacto</th>
                                <th>Correo</th>
                                <th>Logotipo</th>
                                <th>Modificación</th>
                                <th>Trabajos</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cli)
                                <tr>
                                    <td class="filas-tabla">
                                        {{ $cli->nombre }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $cli->contacto }}
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $cli->email }}
                                    </td>
                                    <td class="filas-tabla">
                                        @if ($cli->logo_url)
                                            <img class="imgMuestraAvatar" src="/storage/{{ $cli->logo_url }}"alt="">
                                        @else
                                            {{ $cli->id }}
                                        @endif
                                    </td>

                                    <td class="filas-tabla">
                                        <a href="{{ route('editarcli', $cli->id) }}">
                                            <button type="button" class="btn-modificar">
                                                MODIFICAR
                                            </button>
                                        </a>
                                    </td>
                                    <td class="filas-tabla">
                                        {{ $cli->created_at }}
                                    </td>
                                    <td class="filas-tabla">
                                        <form action="{{ route('elicliente', $cli->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn-eliminar" type="submit">

                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="paginate">
                    {{ $clientes }}
                </div>



            </div>
        </div>
    </div>

</x-app-layout>
