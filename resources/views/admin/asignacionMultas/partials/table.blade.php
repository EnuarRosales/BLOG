<tr>
    <td>{{ $asignacionMulta->id }}</td>
    <td>{{ $asignacionMulta->user->name }}</td>
    <td>{{ $asignacionMulta->tipoMulta->nombre }}</td>
    <td>{{ $asignacionMulta->tipoMulta->costo }}</td>
    <td>{{ $asignacionMulta->created_at }}</td>
    @can('admin.registroMultas.edit')
        <td width="10px">
            <a class="btn btn-secondary btn-sm" href="{{ route('admin.asignacionMultas.edit', $asignacionMulta) }}">Editar</a>
        </td>
    @endcan
    @can('admin.registroMultas.destroy')
        <td width="10px">
            <form class="formulario-eliminar" action="{{ route('admin.asignacionMultas.destroy', $asignacionMulta) }}"
                method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
            </form>
        </td>
    @endcan
</tr>
