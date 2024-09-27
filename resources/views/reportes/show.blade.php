<x-app-layout>
    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="text-3x1 py-4">reporte creado el:  {{ $reporte -> created_at}}</h1>
            <div class="note-buttons">
                <a href="{{ route('reportes.edit', $reporte)}}" class="note-edit-button">Editar</a>
                <form action="{{ route('reportes.destroy', $reporte) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="note-delete-button">borrar</button>
                </form>
            </div>
        </div>
        <div class="note">
            <div class="note-body">
                {{ Str::words($reporte -> id_prestamo)}}
                {{ Str::words($reporte -> descripcion)}}
            </div>
        </div>
    </div>
</x-app-layout>