<x-app-layout>
    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="text-3x1 py-4">usuario creado el:  {{ $usuario -> created_at}}</h1>
            <div class="note-buttons">
                <a href="{{ route('usuarios.edit', $usuario)}}" class="note-edit-button">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">borrar</button>
                </form>
            </div>
        </div>
        <div class="note">
            <div class="note-body">
                {{ Str::words($usuario -> nombre)}}
                {{ Str::words($usuario -> apellido)}}
                {{ Str::words($usuario -> email)}}
                {{ Str::words($usuario -> curso)}}
            </div>
        </div>
    </div>
</x-app-layout>