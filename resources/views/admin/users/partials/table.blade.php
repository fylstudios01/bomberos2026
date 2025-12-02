<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Nombre completo</th>
            <th>Jerarquía</th>
            <th>N° Legajo</th>
            <th>Estado</th>
            <th width="150">Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach($rows as $u)
        <tr>
            <td>{{ $u->id }}</td>

            <td>{{ $u->name }} {{ $u->last_name }}</td>

            <td>
                @if($u->hierarchy)
                    <span class="badge bg-primary">{{ $u->hierarchy->name }}</span>
                @else
                    <span class="badge bg-secondary">Sin jerarquía</span>
                @endif
            </td>

            <td>{{ $u->legajo_number ?? '—' }}</td>

            <td>
                @if($u->enabled)
                    <span class="badge bg-success">Habilitado</span>
                @else
                    <span class="badge bg-danger">Inhabilitado</span>
                @endif
            </td>

            <td class="text-center">

                <!-- VER LEGAJO -->
                <a href="{{ route('users.show', $u->id) }}" class="btn btn-info btn-sm">
                    <i class="bi bi-eye-fill"></i>
                </a>

                <!-- EDITAR -->
                <a href="{{ route('users.edit', $u->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <!-- ELIMINAR -->
                <a href="{{ route('users.destroy', $u->id) }}" class="btn btn-danger btn-sm"
                   onclick="return confirm('¿Seguro quieres eliminar este usuario?');">
                    <i class="bi bi-trash"></i>
                </a>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $rows->links() }}
