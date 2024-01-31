<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subproducts extends Model
{
    use HasFactory;
    public function servicio()
    {
        return $this->belongsTo(Service::class, 'servicio_id', 'id');
    }
    public function producto()
    {
        return $this->belongsTo(Productos::class, 'producto_id', 'id');
    }
    public function detalle()
    {
        return $this->belongsTo(Detalles::class);
    }
}
