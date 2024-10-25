<?php

namespace App\Rules;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Herramienta;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CodigoBarrasUnico implements Rule
{
    public function passes($attribute, $value)
    {
        // Permitir código de barras "0", pero verificar unicidad para otros valores
        if ($value === '0') {
            return true;
        }

        // Aquí validamos si el código de barras ya existe en la base de datos
        $existe = Herramienta::where('codigo_barras', $value)->exists();

        // Si ya existe, devolvemos false
        return !$existe;
    }

    public function message()
    {
        // Mensaje de error personalizado
        return 'El :attribute ya existe y debe ser único si no es 0.';
    }
}