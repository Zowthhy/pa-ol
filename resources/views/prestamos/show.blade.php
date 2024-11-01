<x-app-layout>
    <div class="agregarForm">
        <h1>Prestamo creado el:  {{ $prestamo -> created_at}}</h1>
        <a href="{{ route('prestamos.edit', $prestamo)}}" class="submit">Editar</a>
        <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="cancel">Borrar</button>
        </form>
        <a class="submit" href="{{ url('/reportes/create/' . $prestamo -> id) }}">Reporte</a>

        <label for="reporte">Herramienta:</label>
        {{ Str::words($prestamo -> id_herramienta)}}
        <label for="reporte">Encargado:</label>
        {{ Str::words($prestamo -> id_encargado)}}
        <label for="reporte">Usuario:</label>
        <a style="color: rgb(41, 41, 230)" href="{{ route('usuarios.show', $prestamo->usuario->id)}}">{{ $prestamo->usuario->nombre }} {{ $prestamo->usuario->apellido }}</a>
        <br>
        <h2>Reportes: </h2>
        <ul>
            @foreach($prestamo->reportes as $reporte)
                <li><a href="{{ route('reportes.show', $reporte)}}" style="color: rgb(41, 41, 230)">{{ $reporte->created_at }}</a></li>           
             @endforeach
         </ul>
    </div>
</x-app-layout>