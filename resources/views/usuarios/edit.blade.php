<x-app-layout>
    <div class="note-container single-note">
        <form action="{{ route('usuarios.update', $usuario) }}" method="POST" class="agregarForm">
            @csrf
            @method('PUT')
            <div class="titulo">
                <h1> Editar usuario </h1>
            </div>
            <label for="id_encargado">Nombre:</label>
            <input type="text" name="nombre" value="{{ $usuario -> nombre }}"> 
            <label for="id_encargado">Apellido:</label>
            <input type="text" name="apellido" value="{{ $usuario -> apellido }}"> 
            <label for="id_encargado">Email:</label>
            <input type="text" name="email" value="{{ $usuario -> email }}"> 
            <label for="id_encargado">Curso:</label>
            <input type="text" name="curso" value="{{ $usuario -> curso }}">
            <div class="note-buttons">
                <a href="{{ route('usuarios.index')}}" class="cancel">Cancelar</a> <br>
                <button class="submit">Editar</button>
            </div>
        </form>
    </div>
</x-app-layout>