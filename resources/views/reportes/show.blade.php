<x-app-layout>
    <div class="agregarForm">
        <h1 class="text-3x1 py-4">reporte creado el:  {{ $reporte -> created_at}}</h1>
        <a href="{{ route('reportes.edit', $reporte)}}" class="submit">Editar</a>
        <form action="{{ route('reportes.destroy', $reporte) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="cancel">borrar</button>
        </form>

        <label for="reporte">Id del prestamo:</label>
        <a style="color: rgb(41, 41, 230)" href="{{ route('prestamos.show', $reporte->id_prestamo) }}">{{ $reporte->id_prestamo }}</a>
        <label for="reporte">Reporte:</label>
        {{ Str::words($reporte -> descripcion)}}
    </div>
</x-app-layout>