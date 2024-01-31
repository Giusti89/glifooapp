<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productos extends Model
{
    protected $fillable = [
        'codigo',
        'nombre',
        'servicio_id',      
    ];

    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id', 'id');
    }
    public function subproductos()
    {
        return $this->hasMany(Subproducts::class, 'producto_id', 'id');
    }
}

