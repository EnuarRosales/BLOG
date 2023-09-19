<tr
    @if ($registroDescuento->saldo > 0)
    class="table-warning"
    @elseif($registroDescuento->saldo < 0)
    class="table-danger"
    @else
    class="table-success" @endif>
    <td>{{ $registroDescuento->id }}</td>
    <td>{{ $registroDescuento->created_at }}</td>
    <td>{{ $registroDescuento->montoDescuento }}</td>
    <td>{{ $registroDescuento->montoDescontado }}</td>
    <td>{{ $registroDescuento->saldo }}</td>
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
        <td class="bg-light" width="10px">
            <a class="btn btn-secondary btn-sm"
                href="{{ route('admin.abonos.abonoParcial', $registroDescuento) }}">Parcial</a>
        </td>
    @endcan

    @can('admin.registroDescuentos.edit')
        <td class="bg-light" width="10px">
            <a class="btn btn-secondary btn-sm"
                href="{{ route('admin.registroDescuentos.edit', $registroDescuento) }}">Editar</a>
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
