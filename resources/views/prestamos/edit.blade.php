<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <div class="note-container single-note">
        <h1 class="text-3x1 py-4">Editar prestamo</h1>
        <form action=" {{ route('prestamos.update', $prestamo)}}" method="POST" class="agregarForm">
            @csrf
            @method('PUT')

            <div class="titulo">
                <h1 class="text-3x1 py-4">Editar prestamo</h1>
            </div>

            <label for="id_herramienta">Herramienta:</label>
            <select name="id_herramienta" id="id_herramienta" class="select2">
                <option value="">Seleccione una herramienta</option>
            </select>
            
                <label for="estado">Encargado:</label>
                <input type="number" name="apellido" id="apellido" class="form-control" value="{{ $prestamo -> id_encargado }}" required>

            
                <label for="id_usuario">Usuario:</label>
                <select name="id_usuario" id="id_usuario" class="select2" required>
                    <option value="">Seleccione un usuario</option>
                </select> <br>

            
                <label for="codigo">Devolucion: </label>
                <input type="text" name="curso" id="curso" class="form-control" value="{{ $prestamo -> devolucion }}" required>

            <div class="note-buttons">
                <a href="{{ route('prestamos.index')}}" class="note-cancel-button">Cancelar</a>
                <button class="note-submit-button">Confirmar</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            // Inicializar Select2 para herramientas
            $('#id_herramienta').select2({
                ajax: {
                    url: '{{ route('buscar.herramientas') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            search: params.term // término de búsqueda
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.codigo_barras
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

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