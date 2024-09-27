<x-app-layout>
    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="text-3x1 py-4">prestamo creado el:  {{ $prestamo -> created_at}}</h1>
            <div class="note-buttons">
                <a href="{{ route('prestamos.edit', $prestamo)}}" class="note-edit-button">Editar</a>
                <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">borrar</button>
                </form>
            </div>
        </div>
        <div class="note">
            <div class="note-body">
                {{ Str::words($prestamo -> id_herramienta)}}
                {{ Str::words($prestamo -> id_encargado)}}
                {{ Str::words($prestamo -> id_usuario)}}
                {{ Str::words($prestamo -> devolucion)}}
            </div>
        </div>
    </div>
</x-app-layout>