<x-app-layout>

    <a href="{{ route('usuarios.create') }}" class="agregarBoton"><p>+ Agregar usuario</p></a>

     <!-- Barra de búsqueda -->
     <form class="barraBusqueda" action="{{ route('usuarios.index') }}" method="GET">
        <input type="text" class="inputBusqueda" name="search" placeholder="Buscar por apellido del Usuario" value="{{ request('search') }}">
        <button type="submit" class="botonBusqueda">Buscar</button>
    </form>

    <div class="usuarios">
        <h1 class="titulo">Usuarios</h1>
        <table class="usuariosTable">
            <tr>
                <th>ID usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Curso</th>
                <th colspan="3">Opciones</th>
            </tr>
        @foreach ($usuarios as $usuario)
        <div class="usuario">
            <tr>
                <th>{{ Str::words($usuario -> id)}}</th>
                <th>{{ Str::words($usuario -> nombre)}}</th>
                <th> {{ Str::words($usuario -> apellido)}}</th>
                <th> {{ Str::words($usuario -> email)}}</th>
                <th> {{ Str::words($usuario -> curso)}}</th>
                <div class="buttons">
                <th class="show-button"><a href="{{ route('usuarios.show', $usuario) }}">Ver</a></th>
                <th class="edit-button"><a href="{{ route('usuarios.edit', $usuario) }}">Editar</a></th>
                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <th class="delete-button"><button>Borrar</button></th> 
                    </form>
            </tr>
        </div>
        @endforeach
    </div>

    {{ $usuarios->links() }}
</x-app-layout>