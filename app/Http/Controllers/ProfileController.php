<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\rol;
use App\Models\Service;
use App\Models\cargo;
use App\Models\User;
use  Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\cliente;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $cargo = Cargo::pluck('id', 'nombre');
        $servicio = Service::pluck('id', 'nombre');
        $role = rol::pluck('id', 'nombre');
        return view('profile.edit', [
            'user' => $request->user(),
        ], compact('role', 'servicio', 'cargo'));
    }

    public function editacion($id)
    {
        $cargo = Cargo::pluck('id', 'nombre');
        $servicio = Service::pluck('id', 'nombre');

        $miembro = User::select('users.id as id','users.password as pass' ,'users.fotoPerfil as foto', 'users.fondoPerfil as perfil', 'users.name', 'users.email', 'rols.nombre as rol', 'services.nombre as servicio', 'cargos.nombre as cargo')
            ->join('rols', 'users.rol_id', '=', 'rols.id')
            ->join('services', 'users.servicio_id', '=', 'services.id')
            ->join('cargos', 'users.cargo_id', '=', 'cargos.id')
            ->where('users.id', $id)
            ->first();


        if ($miembro) {
            return view('usuarios.editusuarios', compact('miembro', 'servicio', 'cargo'));
        } else {

            return redirect()->route('ruta_de_redireccion')->with('error', 'Usuario no encontrado');
        }
    }

    /**
     * Update the user's profile information.
     */
    public function abc(Request $request, $id)
    {

        $usuario = User::find($id);

        $usuario->name = $request->input('nombre') ?? $usuario->name;
        $usuario->email = $request->input('email') ?? $usuario->email;

        if ($request->filled('password')) {
            // Generar el hash para la nueva contraseña
            $hashedPassword = Hash::make($request->input('password'));
    
            // Actualizar la contraseña en la base de datos
            $usuario->password = $hashedPassword;
        }

        $usuario->servicio_id = $request->input('servicio_id') ?? $usuario->servicio_id;
        $usuario->cargo_id = $request->input('cargo') ?? $usuario->cargo_id;


        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            Storage::delete('public/' . $usuario->fotoPerfil);

            $path = Storage::putFile('public/perfiles', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $usuario->fotoPerfil = $nuevo_path;
        }

        if ($request->hasFile('backgon')) {
            $file = $request->file('backgon');
            Storage::delete('public/' . $usuario->fondoPerfil);
            $path = Storage::putFile('public/perfiles', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $usuario->fondoPerfil = $nuevo_path;
        }





        $usuario->update();
        return redirect()->route('dashboard');
    }
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $user->servicio_id = $request->input('servicio_id');
        $user->rol_id = $request->input('rol_id');
        $user->cargo_id = $request->input('cargo_id');

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            Storage::delete('public/' . $user->fotoPerfil);

            $path = Storage::putFile('public/perfiles', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $user->fotoPerfil = $nuevo_path;
        }

        if ($request->hasFile('backgon')) {
            $file = $request->file('backgon');
            Storage::delete('public/' . $user->fondoPerfil);
            $path = Storage::putFile('public/perfiles', $file);
            $nuevo_path = str_replace('public/', '', $path);
            $user->fondoPerfil = $nuevo_path;
        }
        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function eliminar( $id)
    {        
        $usuario = User::find($id); 
        if ($usuario->cargo_id==1) {
            return redirect()->route('dashboard')->with('error', 'No puedes eliminar este usuario es un administrador.');
        }
        if ($usuario->fotoPerfil && $usuario->fondoPerfil) {
            Storage::delete('public/' . $usuario->fondoPerfil);
            Storage::delete('public/' . $usuario->fotoPerfil);
        }

        $usuario->delete();
        return redirect()->route('dashboard')->with('success', 'Usuario eliminado');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        
        $user = $request->user();
        if ($user->fotoPerfil && $user->fondoPerfil) {
            Storage::delete('public/' . $user->fotoPerfil);
            Storage::delete('public/' . $user->fondoPerfil);
        }
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return Redirect::to('/');
    }
    public function tarjetas()
    {
        $logo = Cliente::all('logo_url');

        $coleccion= User::where('name', 'like', 'Glifoo')->select('fotoPerfil as foto', 'fondoPerfil as fondo')->first();

        $fotos = User::select('users.id as id', 'users.fotoPerfil as foto', 'users.fondoPerfil as perfil', 'users.name', 'users.email', 'N.nombre as rol', 'S.nombre as servicio', 'C.nombre as cargo')
            ->join('rols as N', 'users.rol_id', '=', 'N.id')
            ->join('services as S', 'users.servicio_id', '=', 'S.id')
            ->join('cargos as C', 'users.cargo_id', '=', 'C.id')
            ->orderBy('users.id', 'asc')
            ->get();
        return view('nosotros', compact('fotos','coleccion','logo'));
    }
}
