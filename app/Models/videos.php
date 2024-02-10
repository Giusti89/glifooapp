<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videos extends Model
{

    use HasFactory;
    protected $fillable = [
        'ruta',
        'spot_id',            
    ];
    public function spot()
    {
        return $this->belongsTo(Spots::class);
    }
}
