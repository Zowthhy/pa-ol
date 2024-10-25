
<x-app-layout>
    <div class="note-container single-note">
        <form action=" {{ route('reportes.update', $reporte)}}" method="POST" class="agregarForm">
            @csrf
            @method('PUT')
            <div class="titulo"><h1>Editar reporte</h1></div>
            <label for="id_prestamo">Id prestamo:</label>
            <input type="text" name="id_prestamo" id="nombre" class="form-control" value="{{ $reporte -> id_prestamo }}" required>
            <label for="reporte">Reporte:</label>
            <textarea name="descripcion" rows="10" class="note-body" value="{{ Str::words($reporte -> descripcion)}}"  required></textarea>
            <div class="note-buttons">
                <a href="{{ route('reportes.index')}}" class="cancel">Cancelar</a> <br>
                <button class="submit">Agregar</button>
            </div>
        </form>
    </div>
</x-app-layout>