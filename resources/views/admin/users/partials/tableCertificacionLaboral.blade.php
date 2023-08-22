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
        <a class="btn btn-secondary btn-sm" target="_blank"
            href="{{ route('admin.users.certificacionLaboralPDF', $user) }}">Ver</a>
    </td>
</tr>
