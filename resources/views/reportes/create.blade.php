<x-app-layout>
    <div class="note-container single-note">
        <form action="{{ route('reportes.store') }}" method="POST" class="agregarForm">
            @csrf
            <div class="titulo"><h1>Agregar reporte </h1></div>
            <input type="number" name="id_prestamo" placeholder="ID del prestamo"> <br>
            <textarea name="descripcion" rows="10" class="note-body" placeholder="Descripcion..."></textarea>
            <div class="note-buttons">
                <a href="{{ route('reportes.index')}}" class="cancel">Cancelar</a> <br>
                <button class="submit">Agregar</button>
            </div>
        </form>
    </div>
</x-app-layout>