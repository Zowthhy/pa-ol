<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reporte extends Model
{
    use HasFactory;
    protected $fillable = ['id_prestamo', 'descripcion'];

    public function prestamo()
{
    return $this->belongsTo(Prestamo::class, 'id_prestamo');
}
}
