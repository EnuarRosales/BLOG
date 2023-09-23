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
    @can(['admin.registroDescuentos.total', 'admin.registroDescuentos.parcial'])
        <td class="" width="10px">
            <div style="display: flex;">

                <form action="{{ route('admin.abonos.abono', $registroDescuento) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-success btn-sm">Total</button>
                </form>

                <a class="btn btn-info btn-sm"
                    href="{{ route('admin.abonos.abonoParcial', $registroDescuento) }}">Parcial</a>
            </div>
        </td>
    @endcan

    {{-- @can('admin.registroDescuentos.parcial')
        <td width="10px">

        </td>
    @endcan --}}

    @can('admin.registroDescuentos.edit')
        <td width="10px">
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
        <td width="10px">
            <a href="javascript:void(0);" class="ml-2 eliminar-registro rounded bs-tooltip" data-placement="top"
                title="Eliminar" data-registroDescuento-id="{{ $registroDescuento->id }}">
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
