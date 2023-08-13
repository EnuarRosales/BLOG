@can('admin.registroProduccion.edit')
    <td width="10px">
        <a class="btn btn-secondary btn-sm" href="{{ route('admin.registroProducidos.edit', $registroProducido) }}">Editar</a>
    </td>
@endcan

@can('admin.registroProduccion.destroy')
    <td width="10px">
        <form class="formulario-eliminar" action="{{ route('admin.registroProducidos.destroy', $registroProducido) }}"
            method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
        </form>
    </td>
@endcan
