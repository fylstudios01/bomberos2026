@extends('admin.layouts.app')

@section('content')

<style>
    .filter-badge {
        cursor: pointer;
        padding: 4px 10px;
        border-radius: 6px;
        background: #e9ecef;
        transition: 0.2s;
        font-size: 13px;
    }
    .filter-badge:hover {
        background: #ced4da;
    }
</style>

<div class="container mt-4">

    <h2 class="mb-4 fw-bold">Listado de Personal</h2>

    <!-- ======================= BUSCADOR AUTOMÁTICO ======================= -->
    <div class="card mb-4">
        <div class="card-body">

            <div class="row g-3">

                <!-- BUSCADOR EN VIVO -->
                <div class="col-md-4">
                    <label class="form-label fw-bold">Buscar personal</label>
                    <input type="text" id="search" class="form-control" placeholder="Nombre, apellido o legajo...">
                </div>

                <!-- BOTÓN FILTROS -->
                <div class="col-md-2 d-flex align-items-end">
                    <div class="dropdown w-100">
                        <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            Filtros
                        </button>
                        <ul class="dropdown-menu w-100">

                            <li><h6 class="dropdown-header">Ordenar por nombre</h6></li>
                            <li><span class="dropdown-item filter-badge" data-sort="name_asc">A → Z</span></li>
                            <li><span class="dropdown-item filter-badge" data-sort="name_desc">Z → A</span></li>

                            <li><hr></li>

                            <li><h6 class="dropdown-header">Ordenar por jerarquía</h6></li>
                            <li><span class="dropdown-item filter-badge" data-sort="hierarchy_up">Mayor → menor</span></li>
                            <li><span class="dropdown-item filter-badge" data-sort="hierarchy_down">Menor → mayor</span></li>

                            <li><hr></li>

                            <li><h6 class="dropdown-header">Ordenar por Nº legajo</h6></li>
                            <li><span class="dropdown-item filter-badge" data-sort="legajo_up">Mayor → menor</span></li>
                            <li><span class="dropdown-item filter-badge" data-sort="legajo_down">Menor → mayor</span></li>

                        </ul>
                    </div>
                </div>

                <!-- BOTÓN CREAR -->
                <div class="col-md-2 d-flex justify-content-end align-items-end">
                    <a class="btn btn-success w-100" href="{{ route('users.create') }}">
                        + CREAR
                    </a>
                </div>

            </div>

        </div>
    </div>

    <!-- ======================= TABLA ======================= -->
    <div class="table-responsive" id="table-container">

        @include('admin.users.partials.table', ['rows' => $rows])

    </div>

</div>

@endsection


<!-- ======================= SCRIPTS AJAX ======================= -->
@section('scripts')
<script>
    let timeout = null;

    // ================= BUSCADOR EN VIVO ====================
    document.getElementById('search').addEventListener('keyup', function () {
        clearTimeout(timeout);

        timeout = setTimeout(() => {
            fetchTable();
        }, 200);
    });

    // ================= FILTROS ====================
    document.querySelectorAll('.filter-badge').forEach(el => {
        el.addEventListener('click', function () {
            document.getElementById('search').setAttribute('data-sort', this.dataset.sort);
            fetchTable();
        });
    });

    // ================= PETICIÓN AJAX ====================
    function fetchTable() {
        let search = document.getElementById('search').value;
        let sort = document.getElementById('search').getAttribute('data-sort') || '';

        fetch("{{ route('users.search') }}?search=" + search + "&sort=" + sort)
            .then(res => res.text())
            .then(html => {
                document.getElementById('table-container').innerHTML = html;
            });
    }
</script>
@endsection
