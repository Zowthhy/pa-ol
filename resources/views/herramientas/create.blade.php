<x-app-layout>
    <div class="note-container single-note">
        <form action="{{ route('herramientas.store') }}" method="POST" class="agregarForm">
            <div class="titulo">
                <h1>Agregar herramienta </h1>
            </div>

            @csrf
            <label>Estado de la herramienta:</label>
            <input type="text" name="estado" placeholder="Condición de la herramienta"  required>
            <label>tipo de herramienta:</label>
            <input type="text" name="tipo_herramienta" placeholder="tipo de herramienta"  required> 
            <label>Codigo de barras:</label>
            <input type="text" name="codigo_barras" placeholder="codigo de barras (Dejar vacio si no tiene)">
            <label for="disponible">Marcar si la herramienta esta disponible:
            <input type="checkbox" name="disponible" id="disponible" value="1" {{ old('activo', $modelo->activo ?? true) ? 'checked' : '' }}> </label>
                <a href="{{ route('herramientas.index')}}" class="cancel">Cancelar</a> 
                <button class="submit">Agregar</button>
            </div>
        </form>
    </div>
</x-app-layout>
