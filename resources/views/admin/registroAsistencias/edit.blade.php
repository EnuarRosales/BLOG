@extends('template.index')

@section('tittle-tab')
    Reporte de Asistenicias-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de Asistenicias</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar asistencia</h2>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <form method="POST" action="{{ route('admin.registroAsistencias.update', $registroAsistencia) }}">
                @csrf
                @method('PUT') {{-- Agrega el método PUT --}}

                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" value="{{ $registroAsistencia->fecha }}" class="form-control">
                    @error('fecha')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="mi_hora">Hora</label>
                    <input type="time" name="mi_hora" value="{{ $registroAsistencia->mi_hora }}" class="form-control"
                        id="mi_hora">
                    @error('mi_hora')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <label for="user_id">Usuario</label>
                    <select name="user_id" class="form-control" id="user_id">
                        <option value="">Seleccione Un Usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                data-TurnoName="{{ $user->asignacionTurnos->first() ? $user->asignacionTurnos->first()->turno->nombre : 'No tiene turno asignado' }}"
                                data-Hora="{{ $user->asignacionTurnos->first() ? $user->asignacionTurnos->first()->turno->horaIngreso . ' - ' . $user->asignacionTurnos->first()->turno->horaTermino : 'No tiene Hora asignada' }}"
                                data-Entrada="{{ $user->asignacionTurnos->first() ? $user->asignacionTurnos->first()->turno->horaIngreso : '' }}"
                                {{ $user->id == $registroAsistencia->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    <!-- Resto del formulario -->

                    <label for="asignacionTurnos">Turno Asignado</label>
                    <div class="input-group">
                        <input type="text" name="asignacionTurnos" value="{{ old('asignacionTurnos') }}"
                            class="form-control" id="asignacionTurnos" disabled>
                        <div class="input-group-append">
                            <button type="button" id="asignarTurnoBtn" class="btn btn-primary" style="display: none"
                                data-url="{{ route('admin.asignacionTurnos.index') }}">Asignar Turno</button>
                        </div>
                    </div><br>

                    @foreach ($asistencia as $item)
                        <input type="text" name="tiempo" value="" class="form-control" id="tiempo"
                            data-Nombre="{{ $item->nombre }}" data-Clase="{{ $item->clase }}"
                            data-Tiempo="{{ $item->tiempo }}" disabled hidden>
                    @endforeach

                    <div class="col-3">
                        <div>
                            <button id="button-tiempo" name="" disabled class="btn btn-info">Seleccione un
                                Usuario</button>
                            <input type="hidden" name="control" value="tu_valor_aqui" id="button-tiempo2">
                        </div>
                    </div><br>

                    <div class="col-2">
                        <div class="d-flex align-items-center h-100" style="">
                            <div>
                                <input type="radio" name="multa" id="multa" onclick="toggleRadio()" >
                            </div>
                            <div>
                                <label for="multa" class="form-check-label ml-2">
                                    Poner Multa
                                </label>
                                <input type="hidden" name="multa_id" value="{{ $registroAsistencia->multa_id }}">
                            </div>
                        </div>
                    </div><br>

                    <button type="submit" class="btn btn-primary">Actualizar Asistencia</button>
                </div>
            </form>
        </div>
    </div>

@stop

@section('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userSelect = document.getElementById('user_id');
            var asignacionTurnosField = document.getElementById('asignacionTurnos');

            var selectedUserId = userSelect.value;
            var selectedOption = userSelect.options[userSelect.selectedIndex];

            // Obtener los valores de data-* del option seleccionado
            var turnoName = selectedOption.getAttribute('data-TurnoName');
            var hora = selectedOption.getAttribute('data-Hora');
            var Entrada = selectedOption.getAttribute('data-Entrada');
            var inputMiHora = document.getElementById('mi_hora');
            // Obtén el valor del campo
            var miHora = inputMiHora.value;
            var buttonTiempo = document.getElementById('button-tiempo');
            var multaCheckbox = document.getElementById('multa');

            // Comprobar si hay un turno asignado
            if (selectedUserId == '') {
                asignacionTurnosField.value = '';
                buttonTiempo.textContent = 'Seleccione Un Usuario'
                buttonTiempo.className = "btn btn-info";
                multaCheckbox.disabled = true;
                multaCheckbox.checked = false;
            } else if (turnoName === 'No tiene turno asignado') {
                // No tiene turno asignado, mostrar el mensaje correspondiente
                asignacionTurnosField.value = turnoName;
                buttonTiempo.className = "btn btn-info";
                multaCheckbox.disabled = true;
                multaCheckbox.checked = false;
            } else {
                // Formatear la hora en formato 12 horas (AM/PM)
                var horas = hora.split(' - ').map(function(time) {
                    var parts = time.split(':');
                    var hour = parseInt(parts[0]);
                    var minute = parts[1];
                    var ampm = hour >= 12 ? 'pm' : 'am';
                    if (hour > 12) {
                        hour -= 12;
                    }
                    return hour + ':' + minute + ' ' + ampm;
                });

                // Mostrar los valores en el campo "Asignación de Turnos"
                asignacionTurnosField.value = turnoName + ' - ' + horas.join(' - ');

                // Convierte las horas en objetos Date para realizar la resta
                var miHoraDate = new Date('1970-01-01T' + miHora);
                var EntradaDate = new Date('1970-01-01T' + Entrada);

                // Calcula la diferencia en milisegundos
                var diferenciaEnMilisegundos = miHoraDate - EntradaDate;

                // Convierte la diferencia en segundos
                var diferenciaEnSegundos = (diferenciaEnMilisegundos / 1000);

                var buttonTiempo = document.getElementById('button-tiempo');
                var buttonTiempo2 = document.getElementById('button-tiempo2');
                var inputTiempo = document.getElementById('tiempo');
                var dataNombre = inputTiempo.getAttribute('data-Nombre');
                var dataClase = inputTiempo.getAttribute('data-Clase');
                var dataTiempo = parseInt(inputTiempo.getAttribute('data-Tiempo'));

                var multaCheckbox = document.getElementById('multa');

                if (diferenciaEnSegundos < 0) {
                    buttonTiempo.textContent = "A Tiempo";
                    buttonTiempo2.value = "A Tiempo";
                    buttonTiempo.className = "btn btn-success";
                    multaCheckbox.disabled = true;
                    multaCheckbox.checked = false;
                } else if (diferenciaEnSegundos < dataTiempo) {
                    buttonTiempo.textContent = dataNombre;
                    buttonTiempo.className = dataClase;
                    buttonTiempo2.value = dataNombre;
                    multaCheckbox.disabled = false;
                    multaCheckbox.checked = false;
                } else {
                    buttonTiempo.textContent = "Retardado";
                    buttonTiempo2.value = "Retardado";
                    buttonTiempo.className = "btn btn-danger";
                    multaCheckbox.disabled = false;
                    multaCheckbox.checked = true;
                    radioActivo = 1;
                }
            }

        });

        var radioActivo = 0;

        function toggleRadio() {
            var radio = document.getElementById("multa");
            if (radioActivo == 0) {
                radio.checked = true;
                radioActivo = 1;
            } else {
                radioActivo = 0;
                radio.checked = false;
            }
        }

        $(document).ready(function() {
            var userSelect = document.getElementById('user_id');
            var asignacionTurnosField = document.getElementById('asignacionTurnos');

            userSelect.addEventListener('change', function() {
                var selectedUserId = this.value;
                var selectedOption = this.options[this.selectedIndex];

                // Obtener los valores de data-* del option seleccionado
                var turnoName = selectedOption.getAttribute('data-TurnoName');
                var hora = selectedOption.getAttribute('data-Hora');
                var Entrada = selectedOption.getAttribute('data-Entrada');
                var inputMiHora = document.getElementById('mi_hora');
                // Obtén el valor del campo
                var miHora = inputMiHora.value;
                var buttonTiempo = document.getElementById('button-tiempo');
                var multaCheckbox = document.getElementById('multa');

                // Comprobar si hay un turno asignado
                if (selectedUserId == '') {
                    asignacionTurnosField.value = '';
                    buttonTiempo.textContent = 'Seleccione Un Usuario'
                    buttonTiempo.className = "btn btn-info";
                    multaCheckbox.disabled = true;
                    multaCheckbox.checked = false;
                } else if (turnoName === 'No tiene turno asignado') {
                    // No tiene turno asignado, mostrar el mensaje correspondiente
                    asignacionTurnosField.value = turnoName;
                    buttonTiempo.className = "btn btn-info";
                    multaCheckbox.disabled = true;
                    multaCheckbox.checked = false;
                } else {
                    // Formatear la hora en formato 12 horas (AM/PM)
                    var horas = hora.split(' - ').map(function(time) {
                        var parts = time.split(':');
                        var hour = parseInt(parts[0]);
                        var minute = parts[1];
                        var ampm = hour >= 12 ? 'pm' : 'am';
                        if (hour > 12) {
                            hour -= 12;
                        }
                        return hour + ':' + minute + ' ' + ampm;
                    });

                    // Mostrar los valores en el campo "Asignación de Turnos"
                    asignacionTurnosField.value = turnoName + ' - ' + horas.join(' - ');

                    // Convierte las horas en objetos Date para realizar la resta
                    var miHoraDate = new Date('1970-01-01T' + miHora);
                    var EntradaDate = new Date('1970-01-01T' + Entrada);

                    // Calcula la diferencia en milisegundos
                    var diferenciaEnMilisegundos = miHoraDate - EntradaDate;

                    // Convierte la diferencia en segundos
                    var diferenciaEnSegundos = (diferenciaEnMilisegundos / 1000);

                    var buttonTiempo = document.getElementById('button-tiempo');
                    var buttonTiempo2 = document.getElementById('button-tiempo2');
                    var inputTiempo = document.getElementById('tiempo');
                    var dataNombre = inputTiempo.getAttribute('data-Nombre');
                    var dataClase = inputTiempo.getAttribute('data-Clase');
                    var dataTiempo = parseInt(inputTiempo.getAttribute('data-Tiempo'));

                    var multaCheckbox = document.getElementById('multa');

                    if (diferenciaEnSegundos < 0) {
                        buttonTiempo.textContent = "A Tiempo";
                        buttonTiempo2.value = "A Tiempo";
                        buttonTiempo.className = "btn btn-success";
                        multaCheckbox.disabled = true;
                        multaCheckbox.checked = false;
                    } else if (diferenciaEnSegundos < dataTiempo) {
                        buttonTiempo.textContent = dataNombre;
                        buttonTiempo.className = dataClase;
                        buttonTiempo2.value = dataNombre;
                        multaCheckbox.disabled = false;
                        multaCheckbox.checked = false;
                    } else {
                        buttonTiempo.textContent = "Retardado";
                        buttonTiempo2.value = "Retardado";
                        buttonTiempo.className = "btn btn-danger";
                        multaCheckbox.disabled = false;
                        multaCheckbox.checked = true;
                        radioActivo = 1;
                    }
                }

            });

            var userSelect = document.getElementById('user_id');
            var asignacionTurnosField = document.getElementById('asignacionTurnos');
            var asignarTurnoBtn = document.getElementById('asignarTurnoBtn');
            var buttonTiempo = document.getElementById('button-tiempo');
            var buttonTiempo2 = document.getElementById('button-tiempo2');

            userSelect.addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var turnoName = selectedOption.getAttribute('data-TurnoName');

                if (turnoName === 'No tiene turno asignado') {
                    asignarTurnoBtn.style.display = 'block'; // Mostrar el botón
                    buttonTiempo.textContent = "No tiene turno asignado";
                    buttonTiempo2.value = "No tiene turno asignado";

                } else {
                    asignarTurnoBtn.style.display = 'none'; // Ocultar el botón
                }
            });

            var miHoraInput = document.getElementById('mi_hora');
            var asignacionTurnosField = document.getElementById('asignacionTurnos');

            // Función para manejar el cambio en "mi_hora" y ejecutar simulateUserChange() si asignacionTurnos no está vacío
            miHoraInput.addEventListener('change', function() {
                // Obten el valor actual de "mi_hora"
                var nuevoValorMiHora = miHoraInput.value;

                // Verifica si el campo asignacionTurnos no está vacío
                if (asignacionTurnosField.value.trim() !== '') {
                    // Ejecuta la función simulateUserChange() solo si asignacionTurnos no está vacío
                    simulateUserChange();
                }

                // Puedes agregar más lógica aquí si es necesario
            });

            function simulateUserChange() {
                var event = new Event('change');
                userSelect.dispatchEvent(event);
            }

            document.getElementById('asignarTurnoBtn').addEventListener('click', function() {
                var url = this.getAttribute('data-url');
                if (url) {
                    window.location.href = url;
                }
            });


        });
    </script>
@endsection
