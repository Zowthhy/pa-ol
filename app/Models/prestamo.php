<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestamo extends Model
{
    use HasFactory;

    protected $fillable = ['id_herramienta', 'id_encargado', 'id_usuario', 'devolucion'];

public function herramienta()
{
    return $this->belongsTo(Herramienta::class, 'id_herramienta');
}

public function encargado()
{
    return $this->belongsTo(User::class, 'id_encargado');
}

public function usuario()
{
    return $this->belongsTo(Usuario::class, 'id_usuario');
}
}
