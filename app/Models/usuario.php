<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'apellido', 'email', 'curso'];

    public function getNombreCompletoAttribute()
{
    return $this->nombre . ' ' . $this->apellido;
}

}
