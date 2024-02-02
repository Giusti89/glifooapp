<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class advertisings extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion'];
    
    public function spot()
    {
        return $this->hasOne(Spots::class);
    }
}
