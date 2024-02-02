<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articles extends Model
{

    use HasFactory;
    protected $fillable = [
        'spot_id',
        'titulo',
        'contenido',      
    ];
    public function spot()
    {
        return $this->belongsTo(Spots::class);
    }
}
