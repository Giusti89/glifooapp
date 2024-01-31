<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sells extends Model
{
    use HasFactory;
    public function spot()
    {
        return $this->belongsTo(Spots::class);
    }
}
