<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Actualice la información del perfil y la dirección de correo electrónico de su cuenta.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Correo')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if (auth()->user()->rol_id == '1')
            <div>
                <x-input-label for="servicio" :value="__('Seleccione la categoria que corresponda')" />
                <select id="servicio_id" name="servicio_id" class="mt-4">

                    @foreach ($servicio as $nombre => $id)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>

            </div>
            <div>
                <x-input-label for="rol" :value="__('Seleccione rol correspondiente')" />
                <select id="rol_id" name="rol_id" class="mt-4">
                    @foreach ($role as $nombre => $id)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-input-label for="cargo" :value="__('Seleccione el cargo correspondiente')" />
                <select id="cargo_id" name="cargo_id" class="mt-4">
                    @foreach ($cargo as $nombre => $id)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>


            <div>
                <x-input-label for="photo" :value="__('Cambiar imagenn')" />
                <input id="file_input" type="file" name="photo">
                </select>
            </div>
            <div>
                <x-input-label for="backgon" :value="__('Cambiar fondo')" />
                <input id="file_input" type="file" name="backgon">
                </select>
            </div>

        @endif


        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Guardar') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
