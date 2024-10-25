<x-app-layout>
    <div class="agregarForm">
        <h1>prestamo creado el:  {{ $prestamo -> created_at}}</h1>
        <a href="{{ route('prestamos.edit', $prestamo)}}" class="submit">Editar</a>
        <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="cancel">borrar</button>
        </form>

        <label for="reporte">Herramienta:</label>
        {{ Str::words($prestamo -> id_herramienta)}}
        <label for="reporte">Encargado:</label>
        {{ Str::words($prestamo -> id_encargado)}}
        <label for="reporte">Usuario:</label>
        <a style="color: rgb(41, 41, 230)" href="{{ route('usuarios.show', $prestamo->usuario->id)}}">{{ $prestamo->usuario->nombre }} {{ $prestamo->usuario->apellido }}</a>
    </div>
</x-app-layout>