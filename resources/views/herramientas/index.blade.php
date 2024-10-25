<x-app-layout>

        <br>
        <a href="{{ route('herramientas.create') }}" class="agregarBoton"><p>+ Agregar Herramienta</p></a>

        <!-- Barra de búsqueda -->
        <form class="barraBusqueda" action="{{ route('herramientas.index') }}" method="GET">
            <input type="text" class="inputBusqueda" name="search" placeholder="Buscar por codigo de barras" value="{{ request('search') }}">
            <button type="submit" class="botonBusqueda">Buscar</button>
        </form>

        <div class="herramientas">
            <h1 class="titulo">Herramientas</h1>
            <table class="herramientasTable">
                <tr>
                    <th>ID Herramienta</th>
                    <th>Estado</th>
                    <th>Tipo</th>
                    <th>Codigo de barras</th>
                    <th>Disponible</th>
                    <th colspan="3">Opciones</th>
                </tr>
            @foreach ($herramientas as $herramienta)
            <div class="herramienta">
                <tr>
                    <th> {{ Str::words($herramienta -> id)}}</th>
                    <th> {{ Str::words($herramienta -> estado)}}</th>
                    <th> {{ Str::words($herramienta -> tipo_herramienta)}}</th>
                    <th> {{ Str::words($herramienta -> codigo_barras)}}</th>
                    @if ($herramienta -> disponible == 1)
                    <th>Si</th>
                    @else
                    <th>No</th>
                    @endif
                    <div class="buttons">
                    <th class="show-button"><a href="{{ route('herramientas.show', $herramienta) }}">Ver</a></th>
                    <th class="edit-button"><a href="{{ route('herramientas.edit', $herramienta) }}">Editar</a></th>
                    <form action="{{ route('herramientas.destroy', $herramienta) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <th class="delete-button"><button>Borrar</button></th> 
                        </form>
                </tr>
            </div>
            @endforeach
        </div>

        {{ $herramientas->links() }}
</x-app-layout>