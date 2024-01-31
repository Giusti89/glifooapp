<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class solicitudes extends Model
{
    use HasFactory;
    protected $table = 'solicitudes';

    protected $fillable = ['concepto', 'servicio_id', 'cliente_id'];

    // Relaciones
    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function detalles()
    {
        return $this->hasMany(Detalles::class);
    }
}
