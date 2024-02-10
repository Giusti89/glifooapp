<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class images extends Model
{
    use HasFactory;
    protected $fillable = ['spot_id','ruta','prioridad_id'];
    
    public function spot()
    {
        return $this->belongsTo(Spots::class);
    }

    public function priority()
    {
        return $this->belongsTo(Prioritys::class, 'prioridad_id'); // Especifica el nombre de la clave foránea
    }
}
