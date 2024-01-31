<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalles extends Model
{
    use HasFactory;
    public function solicitud()
    {
        return $this->belongsTo(Solicitudes::class);
    }

    public function subproductos()
    {
        return $this->hasMany(Subproducts::class);
    }

    public function subproducto()
    {
        return $this->belongsTo(subproducts::class, 'subprod_id');
    }
    public function detalles()
{
    return $this->hasMany(Detalles::class, 'solicitud_id');
}
   
}
