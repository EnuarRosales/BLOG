<tr>
    <td>{{ $asistencia->id }}</td>
    <td>{{ $asistencia->user->name }}</td>
    <td>{{ $asistencia->fecha }}</td>
    <td>
        {{ date('g:i a', strtotime($asistencia->mi_hora)) }}
    </td>
    @can('admin.registroAsistencias.control')
        <td>{{ '#' }}</td>
    @endcan
    @can('admin.registroAsistencias.edit')
        <td width="10px">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.registroAsistencias.edit', $asistencia) }}">Editar</a>
        </td>
    @endcan
    @can('admin.registroAsistencias.destroy')
        <td width="10px">
            <form class="formulario-eliminar" action="{{ route('admin.registroAsistencias.destroy', $asistencia) }}"
                method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
            </form>
        </td>
    @endcan
</tr>
