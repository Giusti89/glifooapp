<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class redes extends Model
{
    use HasFactory;

    public function spot()
    {
        return $this->belongsTo(spots::class);
    }    
}
