<x-app-layout>

    <!-- Barra de búsqueda -->
    <form class="barraBusqueda" action="{{ route('reportes.index') }}" method="GET">
        <input type="text" class="barraBusqueda" name="search" placeholder="Buscar por ID," value="{{ request('search') }}">
        <button type="submit">Buscar</button>
    </form>
    <br>
    <a href="{{ route('reportes.create') }}" class="agregarBoton"><p>+ Agregar reporte</p></a>
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
                <th>{{ Str::words($reporte -> id_prestamo)}}</th>
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

