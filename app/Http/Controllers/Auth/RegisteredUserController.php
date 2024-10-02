<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Database\QueryException;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse{
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ]);
        
        try {
            $user = User::create([
                'name' => $request->name,
                'dni' => $request->dni,
                'password' => Hash::make($request->password),
            ]);
        
            event(new Registered($user));
            Auth::login($user);
        
            return redirect(route('herramientas.index', absolute: false));
        
        } catch (QueryException $e) {
            // Si ocurre una violación de restricción de clave única o de clave foránea
            if ($e->getCode() == 23000) {
                // Redirigir con un mensaje de error amigable
                return to_route('register')->with('error', 'DNI ya registrado');
            }
        
            // Si es otro tipo de error, puedes volver a lanzarlo o manejarlo
            throw $e;
        }
    }
}