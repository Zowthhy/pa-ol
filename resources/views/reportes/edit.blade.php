<x-app-layout>
    <div class="note-container single-note">
        <h1 class="text-3x1 py-4">Editar reporte</h1>
        <form action=" {{ route('reportes.update', $reporte)}}" method="POST" class="note">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Prestamo:</label>
                <input type="text" name="id_prestamo" id="nombre" class="form-control" value="{{ $reporte -> id_prestamo }}" required>
                <label for="nombre">Descripcion:</label>
                <textarea name="descripcion" rows="10" class="note-body" value="{{ Str::words($reporte -> descripcion)}}"  required></textarea>
            </div>

            <div class="note-buttons">
                <a href="{{ route('reportes.index')}}" class="note-cancel-button">Cancelar</a>
                <button class="note-submit-button">Confirmar</button>
            </div>
        </form>
    </div>
</x-app-layout>