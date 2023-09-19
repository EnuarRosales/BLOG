<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->fechaIngreso }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->cedula }}</td>
    <td>{{ $user->celular }}</td>
    <td>{{ $user->direccion }}</td>
    <td>{{ $user->email }}</td>
    <td>{{ $user->tipoUsuario->nombre }}</td>
    <td width="10px" style="text-align:center">
        <a class=" bs-tooltip" data-placement="top" title="Ver"
            href="{{ route('admin.users.certificacionLaboralPDF', $user) }}"><svg class="rounded mr-2" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg></a>
    </td>
</tr>
