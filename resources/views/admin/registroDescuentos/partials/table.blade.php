<tr>
    <td>{{ $registroDescuento->id }}</td>
    <td>{{ $registroDescuento->created_at }}</td>
    <td>{{ $registroDescuento->montoDescuento }}</td>
    <td>{{ $registroDescuento->montoDescontado }}</td>
    <td
        @if ($registroDescuento->saldo > 0) class="badge badge-warning mt-2"
    @elseif($registroDescuento->saldo < 0)
    class="badge badge-danger mt-2"
    @else
    class="badge badge-success mt-2" @endif>
        {{ $registroDescuento->saldo }}</td>
    <td>{{ $registroDescuento->tipoDescuento->nombre }}</td>
    <td>{{ $registroDescuento->user->name }}</td>
    @can('admin.registroDescuentos.total')
        <td class="" width="10px">
            <form action="{{ route('admin.abonos.abono', $registroDescuento) }}" method="POST">
                @csrf
                @method('PUT')
                <button type="submit" class="btn btn-dark btn-sm">Total</button>
            </form>
        </td>
    @endcan

    @can('admin.registroDescuentos.parcial')
        <td width="10px">
            <a class="btn btn-secondary btn-sm"
                href="{{ route('admin.abonos.abonoParcial', $registroDescuento) }}">Parcial</a>
        </td>
    @endcan

    @can('admin.registroDescuentos.edit')
        <td  width="10px">
            <a href="{{ route('admin.registroDescuentos.edit', $registroDescuento) }}" class="ml-4 rounded bs-tooltip"
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

    @can('admin.registroDescuentos.destroy')
        <td class="bg-light" width="10px">
            <form class="formulario-eliminar" action="{{ route('admin.registroDescuentos.destroy', $registroDescuento) }}"
                method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
            </form>
        </td>
    @endcan
</tr>
