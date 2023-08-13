<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->fechaIngreso }}</td>
    <td>{{ $user->name }}</td>
    <td style="text-align:center">{{ $year[$i - 1] }}</td>
    <td style="text-align:center">{{ $month[$i - 1] }}</td>
    <td style="text-align:center">{{ $day[$i - 1] }}</td>
    <td width="10px" style="text-align:center">
        <a class="btn btn-secondary btn-sm" target="_blank"
            href="{{ route('admin.users.certificacionTiempoPDF', $user) }}">Ver</a>
    </td>
</tr>