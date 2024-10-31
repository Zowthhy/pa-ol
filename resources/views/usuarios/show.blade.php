<x-app-layout>
    <div class="agregarForm">
            <h1 class="text-3x1 py-4">usuario creado el:  {{ $usuario -> created_at}}</h1>
                <a href="{{ route('usuarios.edit', $usuario)}}" class="submit">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="cancel">borrar</button>
                </form>

                    <label for="">Nombre:</label>
                    {{ Str::words($usuario -> nombre)}}
                    <label for="">Apellido:</label>
                    {{ Str::words($usuario -> apellido)}}
                    <label for="">Email:</label>
                    {{ Str::words($usuario -> email)}}
                    <label for="">Curso:</label>
                    {{ Str::words($usuario -> curso)}}
                    <br>
                    <h2>Préstamos: </h2>
                    <ul>
                        @foreach($usuario->prestamos as $prestamo)
                            <li><a href="{{ route('prestamos.show', $prestamo)}}" style="color: rgb(41, 41, 230)">{{ $prestamo->created_at }}</a></li>           
                        @endforeach
                    </ul>
    </div>
</x-app-layout>