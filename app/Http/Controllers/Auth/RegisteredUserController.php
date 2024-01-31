<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\rol;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use App\Models\cargo;
use  Illuminate\Support\Facades\Storage;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $cargo = Cargo::pluck('id', 'nombre');
        $roler = rol::pluck('id', 'nombre');
        $verificacion = Service::pluck('id', 'nombre');
        return view('auth.register', compact('verificacion', 'roler', 'cargo'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],


        ]);


        $user = User::create([

            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'servicio_id' => $request->chuwanco,
            'rol_id' => $request->rolawco,
            'cargo_id' => $request->marcas,


        ]);

        if ($request->hasFile('fotoPerfil') && $request->file('fotoPerfil')->isValid()) {
            $fotoPerfilPath = $request->file('fotoPerfil')->store('public/perfiles');
            $user->fotoPerfil = str_replace('public/', '', $fotoPerfilPath);
        } else {

            $user->fotoPerfil = ('img/backgrounds/defecto.webp');
        }

        if ($request->hasFile('fondoPerfil') && $request->file('fondoPerfil')->isValid()) {
            $fondoPerfilPath = $request->file('fondoPerfil')->store('public/perfiles');
            $user->fondoPerfil = str_replace('public/', '', $fondoPerfilPath);
        } else {

            $user->fondoPerfil = ('img/backgrounds/defecto.webp');
        }

        $user->save();
        event(new Registered($user));

        // Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Usuario creado exitosamente');
    }

    public function llenar(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

        ]);
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password);
        $usuario->servicio_id = $request->chuwanco;
        $usuario->rol_id = $request->rolawco;
        $usuario->cargo_id = $request->marcas;

        if ($request->hasFile('fotoPerfil')) {
            $file = $request->file('fotoPerfil');

            $path = Storage::putFile('public/perfiles', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $usuario->fotoPerfil = $nuevo_path;
        }
        if ($request->hasFile('fondoPerfil')) {
            $file = $request->file('fondoPerfil');

            $path = Storage::putFile('public/perfiles', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $usuario->fondoPerfil = $nuevo_path;
        }

        $usuario->save();
        return redirect(RouteServiceProvider::HOME);
    }


    public function mostrar()
    {
        $usuario = User::select('users.id as id', 'users.fotoPerfil as foto', 'users.fondoPerfil as perfil', 'users.name', 'users.email', 'N.nombre as rol', 'S.nombre as servicio', 'C.nombre as cargo')
            ->join('rols as N', 'users.rol_id', '=', 'N.id')
            ->join('services as S', 'users.servicio_id', '=', 'S.id')
            ->join('cargos as C', 'users.cargo_id', '=', 'C.id')
            ->orderBy('users.id', 'ASC')
            ->get();

        return view('dashboard', compact('usuario'));
    }
}
