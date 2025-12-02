@extends('admin.layouts.app')

@section('content')
<style>
	/* --- FICHA POLICIAL ULTRA PROFESIONAL --- */

	.ficha-container {
		max-width: 900px;
		margin: auto;
		background: #fff;
		padding: 30px;
		border-radius: 10px;
		border: 1px solid #ddd;
		box-shadow: 0 4px 12px rgba(0,0,0,0.08);
		font-family: 'Segoe UI', sans-serif;
	}

	.ficha-header {
		text-align: center;
		margin-bottom: 30px;
	}

	.ficha-header img {
		height: 120px;
		margin-bottom: 10px;
	}

	.ficha-title {
		font-size: 28px;
		font-weight: bold;
		text-transform: uppercase;
		letter-spacing: 1px;
		color: #222;
	}

	/* FOTO 4x4 */
	.foto-box {
		width: 150px;
		height: 180px;
		border: 2px solid #444;
		margin: auto;
		overflow: hidden;
		border-radius: 4px;
		background: #eee;
	}

	.foto-box img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	/* Fila */
	.data-section {
		margin-top: 30px;
	}

	.data-title {
		font-size: 20px;
		font-weight: bold;
		color: #444;
		padding-bottom: 5px;
		border-bottom: 2px solid #c9c9c9;
		margin-bottom: 15px;
		text-transform: uppercase;
	}

	.row-data {
		display: flex;
		justify-content: space-between;
		padding: 8px 0;
		border-bottom: 1px solid #e3e3e3;
	}

	.row-data:last-child {
		border-bottom: none;
	}

	.row-data strong {
		color: #222;
	}

	/* Insignia de jerarquía */
	.jerarquia-badge {
		display: inline-block;
		padding: 6px 12px;
		background: #004AAD;
		color: white;
		font-weight: bold;
		border-radius: 6px;
		font-size: 14px;
	}

	/* Estado */
	.estado-ok {
		background: #1dab41;
		color: white;
		padding: 4px 8px;
		border-radius: 5px;
		font-weight: bold;
		font-size: 14px;
	}

	.estado-off {
		background: #c12626;
		color: white;
		padding: 4px 8px;
		border-radius: 5px;
		font-weight: bold;
		font-size: 14px;
	}

	/* Botón de imprimir */
	.print-btn {
		margin-top: 30px;
		text-align: center;
	}

	.print-btn button {
		background: #004AAD;
		color: white;
		border: none;
		padding: 12px 30px;
		font-size: 16px;
		border-radius: 8px;
		cursor: pointer;
		font-weight: bold;
	}

	.print-btn button:hover {
		background: #003076;
	}

</style>

<div class="ficha-container">

	<!-- ENCABEZADO -->
	<div class="ficha-header">
		<img src="{{ asset('img/escudo.png') }}" alt="Escudo">
		<div class="ficha-title">Ficha del Personal</div>
	</div>

	<!-- FOTO -->
	<div class="text-center mb-4">
		<div class="foto-box">
			@if($user->photo)
				<img src="{{ asset('uploads/photos/'.$user->photo) }}">
			@else
				<img src="https://cdn-icons-png.flaticon.com/512/149/149071.png">
			@endif
		</div>
	</div>

	<!-- DATOS PERSONALES -->
	<div class="data-section">
		<div class="data-title">Datos Personales</div>

		<div class="row-data">
			<strong>Nombre completo:</strong>
			<span>{{ $user->name }} {{ $user->last_name }}</span>
		</div>

		<div class="row-data">
			<strong>DNI:</strong>
			<span>{{ $user->dni ?: '—' }}</span>
		</div>

		<div class="row-data">
			<strong>Fecha de nacimiento:</strong>
			<span>{{ $user->birthdate ?: '—' }}</span>
		</div>

		<div class="row-data">
			<strong>Dirección:</strong>
			<span>{{ $user->address ?: '—' }}</span>
		</div>
	</div>

	<!-- DATOS INSTITUCIONALES -->
	<div class="data-section">
		<div class="data-title">Información Institucional</div>

		<div class="row-data">
			<strong>Jerarquía:</strong>
			@if($user->hierarchy)
				<span class="jerarquia-badge">{{ $user->hierarchy->name }}</span>
			@else
				<span>Sin jerarquía</span>
			@endif
		</div>

		<div class="row-data">
			<strong>N° de legajo:</strong>
			<span>{{ $user->legajo_number ?: '—' }}</span>
		</div>

		<div class="row-data">
			<strong>Fecha de ingreso:</strong>
			<span>{{ $user->ingreso_date ?: '—' }}</span>
		</div>

		<div class="row-data">
			<strong>Estado:</strong>
			@if($user->enabled)
				<span class="estado-ok">HABILITADO</span>
			@else
				<span class="estado-off">DESHABILITADO</span>
			@endif
		</div>
	</div>

	<!-- CONTACTO -->
	<div class="data-section">
		<div class="data-title">Contacto</div>

		<div class="row-data">
			<strong>Email institucional:</strong>
			<span>{{ $user->email }}</span>
		</div>

		<div class="row-data">
			<strong>Teléfono:</strong>
			<span>{{ $user->phone ?: '—' }}</span>
		</div>
	</div>

	<!-- BOTÓN IMPRIMIR -->
	<div class="print-btn">
    <a href="{{ route('users.pdf', $user->id) }}" target="_blank">
        <button style="background:#004AAD;">Generar PDF Oficial</button>
    </a>
</div>


</div>

@endsection
