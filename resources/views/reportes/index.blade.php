<x-app-layout>

    <br>
    <a href="{{ route('reportes.create') }}" class="agregarBoton"><p>+ Agregar reporte</p></a>

     <!-- Barra de búsqueda -->
    <form class="barraBusqueda" action="{{ route('reportes.index') }}" method="GET">
        <input type="text" class="inputBusqueda" name="search" placeholder="Buscar por ID del prestamo" value="{{ request('search') }}">
        <button type="submit" class="botonBusqueda">Buscar</button>
    </form>

    <div class="reportes">
        <h1 class="titulo">Reportes</h1>
        <table class="reportesTable">
            <tr>
                <th>ID Reporte</th>
                <th>ID Prestamo</th>
                <th>Descripcion</th>
                <th colspan="3">Opciones</th>
            </tr>
        @foreach ($reportes as $reporte)
        <div class="reporte">
            <tr>
                <th>{{ Str::words($reporte -> id)}}</th>
                <th><a style="color: rgb(41, 41, 230)" href="{{ route('prestamos.show', $reporte->id_prestamo) }}">{{ $reporte->id_prestamo }}</a></th>
                <th>{{ Str::words($reporte -> descripcion)}}</th>
                <div class="buttons">
                <th class="show-button"><a href="{{ route('reportes.show', $reporte) }}">Ver</a></th>
                <th class="edit-button"><a href="{{ route('reportes.edit', $reporte) }}">Editar</a></th>
                <form action="{{ route('reportes.destroy', $reporte) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <th class="delete-button"><button>Borrar</button></th> 
                    </form>
            </tr>
        </div>
        @endforeach
    </div>

    {{ $reportes->links() }}
</x-app-layout>

