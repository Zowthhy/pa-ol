<x-app-layout>
    <div class="agregarForm">
            <h1 class="text-3x1 py-4">usuario creado el:  {{ $usuario -> created_at}}</h1>
                <a href="{{ route('usuarios.edit', $usuario)}}" class="submit">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="cancel">borrar</button>
                </form>

                    <label for="">Nombre:</label>
                    {{ Str::words($usuario -> nombre)}}
                    <label for="">Apellido:</label>
                    {{ Str::words($usuario -> apellido)}}
                    <label for="">Email:</label>
                    {{ Str::words($usuario -> email)}}
                    <label for="">Curso:</label>
                    {{ Str::words($usuario -> curso)}}

    </div>
</x-app-layout>