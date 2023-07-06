<div>
    <table id="users" class="table table-striped table-bordered shadow-lg mt-4">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Turno</th>
            <th>Celular</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($asignacionTurnos as $asignacionTurno)
            <tr>
                <td>{{ $asignacionTurno->user->name }}</td>
                <td>{{ $asignacionTurno->turno->nombre }}</td>
                <td>{{ $asignacionTurno->user->celular }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
