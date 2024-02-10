<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class spots extends Model
{
    protected $fillable = ['cliente_id', 'advertising_id', 'boton'];


    use HasFactory;
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function advertising()
    {
        return $this->belongsTo(Advertisings::class, 'advertising_id');
    }
    public function images()
    {
        return $this->hasMany(Images::class);
    }

    public function sells()
    {
        return $this->hasMany(Sells::class);
    }
    public function articles()
    {
        return $this->hasMany(Articles::class);
    }
    public function videos()
    {
        return $this->hasMany(Videos::class);
    }
    public function redes()
    {
        return $this->hasMany(Redes::class);
    }
}
