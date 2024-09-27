<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="note-container single-note">
        <form action="{{ route('prestamos.store') }}" method="POST" class="agregarForm">
            @csrf
            <div class="titulo">
                <h1>Agregar préstamo</h1>
            </div>
            <label for="id_herramienta">Herramienta:</label>
            <input name="id_herramienta" type="text" placeholder="ID de herramienta" required> 

            <label for="id_encargado">Encargado:</label>
            <input type="text" value="{{ Auth::user()->name }}" readonly>
            <input type="text" name="id_encargado" value="{{ Auth::user()->id}}" style="display: none">
            <!-- Select2 para usuarios -->
            <label for="id_usuario">Usuario:</label>
            <select name="id_usuario" id="id_usuario" class="select2" required>
                <option value="">Seleccione un usuario</option>
            </select> <br>

            <div class="note-buttons">
                <a href="{{ route('prestamos.index')}}" class="cancel">Cancelar</a> <br>
                <button class="submit">Agregar</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializar Select2 para encargados
            $('#id_encargado').select2({
                ajax: {
                    url: '{{ route('buscar.encargados') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Inicializar Select2 para usuarios
            $('#id_usuario').select2({
                ajax: {
                    url: '{{ route('buscar.usuarios') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.nombre + ' ' + item.apellido
                                };
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>
</x-app-layout>