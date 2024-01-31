<x-app-layout>
    <link rel="stylesheet" href="./css/dashboard.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900" id="barra">
                    @if (auth()->user()->rol_id == '1')
                        <h2> <b>ESTAFF GLIFOO COMUNICACION DIGITAL</b> </h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Servicio</th>
                                        <th>Rol</th>
                                        <th>Cargo</th>
                                        <th>Reverso de la tarjeta</th>
                                        <th>Frontis del perfil</th>
                                        <th></th>
                                        <th></th>
                                    </tr>

                                <tbody>
                                    @foreach ($usuario as $usu)
                                        @if ($usu->name != 'Glifoo')
                                            <tr>
                                                <td class="filas-tabla">{{ $usu->name }}</td>
                                                <td class="filas-tabla">{{ $usu->email }}</td>
                                                <td class="filas-tabla">{{ $usu->servicio }}</td>
                                                <td class="filas-tabla">{{ $usu->rol }}</td>
                                                <td class="filas-tabla">{{ $usu->cargo }}</td>
                                                <td class="filas-tabla">
                                                    @if ($usu->foto)
                                                        <img src="/storage/{{ $usu->foto }}"alt=""
                                                            class="fotos"><br>
                                                    @else
                                                        {{ $usu->id }}
                                                    @endif
                                                </td>
                                                <td class="filas-tabla">
                                                    @if ($usu->perfil)
                                                        <img src="/storage/{{ $usu->perfil }}"alt=""
                                                            class="fotos"><br>
                                                    @else
                                                        {{ $usu->id }}
                                                    @endif
                                                </td>
                                                <td class="filas-tabla">
                                                    @if (isset($usu))
                                                        <a href="{{ route('editusu', $usu->id) }}">
                                                            <button type="button" class="btn-modificar">
                                                                MODIFICAR
                                                            </button>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="filas-tabla">
                                                    <form action="{{ route('borrarusuario', $usu->id) }}"
                                                        class="formulario-eliminar" id="formulario-eliminar"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button class="btn-eliminar" type="submit"></button>
                                                    </form>
                                                </td>


                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    @else
                        <h3>No eres un administrador del sistema</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
