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
                    <a href="{{ route('admin.registroAsistencias.edit', $asistencia) }}" class="ml-4 rounded bs-tooltip"
                data-placement="top" title="Editar">
                <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-edit-3">
                    <path d="M12 20h9"></path>
                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                </svg>
            </a>
        </td>
    @endcan
    @can('admin.registroAsistencias.destroy')
        <td width="10px">
             <a href="javascript:void(0);" class="ml-2 eliminar-registro rounded bs-tooltip" data-placement="top"
                title="Eliminar" data-asistencia-id="{{ $asistencia->id }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-x-circle table-cancel">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="15" y1="9" x2="9" y2="15"></line>
                    <line x1="9" y1="9" x2="15" y2="15"></line>
                </svg>
            </a>
        </td>
    @endcan
</tr>
