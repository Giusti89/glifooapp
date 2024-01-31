<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',        
    ];

    
    public static function crearRol($nombre)
    {
        return self::create([
            'nombre' => $nombre,
        ]);
    }

    public function modificarRol($nombre)
    {
        $this->update([
            'nombre' => $nombre,
        ]);
    }

    public static function mostrarRoles()
    {
        return self::all();
    }

    public static function buscarPorId($id)
    {
        return self::find($id);
    }
}

