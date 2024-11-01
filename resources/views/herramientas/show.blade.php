<x-app-layout>
    <div class="note-container single-note">
        <div class="note-header">
            <h1 class="text-3x1 py-4">Herramienta creada el:  {{ $herramienta -> created_at}}</h1>
            <div class="note-buttons">
                <a href="{{ route('herramientas.edit', $herramienta)}}" class="edit-button">Editar</a>
                <form action="{{ route('herramientas.destroy', $herramienta) }}" method="POST" onsubmit="return confirmDelete();">
                    @csrf
                    @method('DELETE')
                    <button class="delete-button">borrar</button>
                </form>
            </div>
        </div>
            <table>
                <tr>
                    <th><label for="">Id de herramienta:</label></th>
                    <th >{{ Str::words($herramienta -> id)}}</th> 
                </tr>
                <tr>
                    <th><label for="">Estado de la herramienta:</label></th>
                    <th >{{ Str::words($herramienta -> estado)}}</th> 
                </tr>
                <tr>
                    <th><label for="">Tipo de herramienta:</label></th>
                    <th >{{ Str::words($herramienta -> tipo_herramienta)}}</th> 
                </tr>
                <tr>
                    <th><label for="">Codigo de barras:</label></th>
                    <th >{{ Str::words($herramienta -> codigo_barras)}}</th> 
                </tr>
            </table>

    </div>

    <script>
        function confirmDelete() {
            return confirm('¿Estás seguro de que deseas eliminar esta Herramienta?');
        }
    </script>
</x-app-layout>