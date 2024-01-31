<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Servicio -->
        <div class="mt-4">
            <x-input-label for="servicio" :value="__('Seleccione la categoria que corresponda')" />
            <select name="chuwanco" class="mt-4">
                <option value=""></option>
                @foreach ($verificacion as $nombre => $id)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('chuwanco')" class="mt-2" />
        </div>

        <!-- rol Usuario -->
        <div class="mt-4">
            <x-input-label for="rol" :value="__('Seleccione el rol correspondiente')" />
            <select name="rolawco" class="mt-4">
                <option value=""></option>
                @foreach ($roler as $nombre => $id)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('rolawco')" class="mt-2" />
        </div>
        <!-- cargo Usuario -->
        <div class="mt-4">
            <x-input-label for="marcas" :value="__('Seleccione el cargo correspondiente')" />
            <select name="marcas" class="mt-4">
                <option value=""></option>
                @foreach ($cargo as $nombre => $id)
                    <option value="{{ $id }}">{{ $nombre }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('marcas')" class="mt-2" />
        </div>
        <!-- foto Usuario -->
        <div class="mt-4">
            <x-input-label for="fotoPErfil" :value="__('Seleccione foto del perfil')" />
            <input id="file_input" type="file" name="fotoPerfil" accept="image/jpeg/webp"> 
        </div>
        <!-- fondo Usuario -->
        <div class="mt-4">
            <x-input-label for="fondoPerfil" :value="__('Seleccione fondo del perfil')" />
            <input id="file_input" type="file" name="fondoPerfil" accept="image/jpeg/webp"> 
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Ya te encuentras registrado') }}
            </a> --}}

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>

            <a href="{{ route('dashboard') }}">
                <button data-modal-toggle="defaultModal" type="button" class="underline ml-4">Regresar</button>
            </a>
        </div>
    </form>
</x-guest-layout>
