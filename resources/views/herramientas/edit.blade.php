
<x-app-layout>
    <div class="note-container single-note">
        <form action="{{ route('herramientas.update', $herramienta) }}" method="POST" class="agregarForm">
            @csrf
            @method('PUT')

            <div class="titulo">
                <h1>Editar herramienta ID: {{ $herramienta -> ID }} </h1>
            </div>

            <label>Estado de la herramienta:</label>
            <input type="text" name="estado" value="{{ $herramienta -> estado }}"  required>
            <label>tipo de herramienta:</label>
            <input type="text" name="tipo_herramienta" value="{{ $herramienta -> tipo_herramienta }}"  required> 
            <label>Codigo de barras:</label>
            <input type="text" name="codigo_barras" value="{{ $herramienta -> codigo_barras }}" required>
            <label for="disponible">Marcar si la herramienta esta disponible:
            <input type="checkbox" name="disponible" id="disponible" value="1" {{ old('activo', $modelo->activo ?? false) ? 'checked' : '' }}> </label>
                <a href="{{ route('herramientas.index')}}" class="cancel">Cancelar</a> 
                <button class="submit">Agregar</button>
            </div>
        </form>
    </div>
</x-app-layout>