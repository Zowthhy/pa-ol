<x-app-layout>
    <div class="note-container single-note">
        <form action="{{ route('usuarios.store') }}" method="POST" class="agregarForm">
            @csrf
            <div class="titulo">
                <h1>Agregar usuario </h1>
            </div>
            <label for="id_encargado">Nombre:</label>
            <input type="text" name="nombre" placeholder="nombre"> 
            <label for="id_encargado">Apellido:</label>
            <input type="text" name="apellido" placeholder="apellido"> 
            <label for="id_encargado">Email:</label>
            <input type="text" name="email" placeholder="Email"> 
            <label for="id_encargado">Curso:</label>
            <input type="text" name="curso" placeholder="Curso">
            <div class="note-buttons">
                <a href="{{ route('usuarios.index')}}" class="cancel">Cancelar</a> <br>
                <button class="submit">Agregar</button>
            </div>
        </form>
    </div>
</x-app-layout>