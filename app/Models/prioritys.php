<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prioritys extends Model
{
  
    
    use HasFactory;
    protected $fillable = ['id','nombre'];
    
    public function images()
    {
        return $this->hasMany(images::class);
    }
}
