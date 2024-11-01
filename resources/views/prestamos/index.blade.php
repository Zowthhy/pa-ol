<x-app-layout>
    <!-- Barra de búsqueda -->
    <a href="{{ route('prestamos.create') }}" class="agregarBoton">
        <p>+ Agregar préstamo con código de barras</p>
    </a><br>
    <a href="{{ route('prestamos.crearSinCB') }}" class="agregarBoton">
        <p>+ Agregar préstamo con ID</p>
    </a>

    <form class="barraBusqueda" action="{{ route('buscar.prestamos') }}" method="GET">
        <input type="text" class="inputBusqueda" name="search" placeholder="Buscar por apellido del Usuario" value="{{ request('search') }}">
        <button type="submit" class="botonBusqueda">Buscar</button>
    </form>

    <div class="prestamos">
        <h1 class="titulo">Préstamos</h1>
        <table class="prestamosTable">
            <tr>
                <th>ID préstamo</th>
                <th><a style="color: rgb(41, 41, 230)" href="{{ route('prestamos.index') }}" title="Ordenar préstamos por la fecha de creación" class="btn btn-primary">Prestado el</a></th>
                <th>ID Herramienta</th>
                <th>Encargado</th>
                <th>Usuario</th>
                <th><a style="color: rgb(41, 41, 230)" href="{{ route('prestamos.sin-devolucion') }}" title="Mostrar solo préstamos no devueltos" class="btn btn-primary">Devolución</a></th>
                <th colspan="5">Opciones</th>
            </tr>
            @foreach ($prestamos as $prestamo)
            <div class="prestamo">
                <tr>
                    <th>{{ Str::words($prestamo->id) }}</th>
                    <th>{{ Str::words($prestamo->created_at) }}</th>
                    <th><a style="color: rgb(41, 41, 230)" href="{{ route('herramientas.show', $prestamo->herramienta->id) }}">{{ $prestamo->herramienta->id }}</a></th>
                    <th>{{ $prestamo->encargado->name }}</th>
                    <th><a style="color: rgb(41, 41, 230)" href="{{ route('usuarios.show', $prestamo->usuario->id) }}">{{ $prestamo->usuario->nombre }} {{ $prestamo->usuario->apellido }}</a></th>
                    @if ($prestamo->devolucion == null)
                        <form action="{{ route('prestamos.devolver', $prestamo) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <th class="devolver"><button>Devolver</button></th>
                        </form>
                    @else
                        <th>{{ $prestamo->devolucion }}</th>
                    @endif
                    <div class="buttons">
                        <th class="show-button"><a href="{{ route('prestamos.show', $prestamo->id) }}">Ver</a></th>
                        <th class="edit-button"><a href="{{ route('prestamos.edit', $prestamo->id) }}">Editar</a></th>
                        
                        <!-- Botón de eliminación con confirmación -->
                        <form action="{{ route('prestamos.destroy', $prestamo) }}" method="POST" onsubmit="return confirmDelete();">
                            @csrf
                            @method('DELETE')
                            <th class="delete-button"><button type="submit">Borrar</button></th>
                        </form>

                        <th class="reporte-button">
                            <a href="{{ url('/reportes/create/' . $prestamo->id) }}">+Reporte</a>
                        </th>
                    </div>
                </tr>
            </div>
            @endforeach
        </table>
    </div>

    {{ $prestamos->links() }}

    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar este préstamo?');
        }
    </script>
</x-app-layout>

