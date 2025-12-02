<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Legajo Oficial - {{ $user->last_name }}, {{ $user->name }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .page {
            background: white;
            padding: 40px;
            width: 100%;
            min-height: 100vh;
            border: 2px solid #000;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header img {
            height: 110px;
        }

        .title {
            font-size: 26px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
            letter-spacing: 1px;
        }

        /* FOTO */
        .foto {
            width: 140px;
            height: 170px;
            border: 2px solid #000;
            float: right;
            background: #eee;
            margin-top: -20px;
        }

        .foto img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Secciones */
        .section-title {
            font-size: 18px;
            font-weight: bold;
            border-bottom: 2px solid black;
            margin-top: 20px;
            margin-bottom: 10px;
            padding-bottom: 3px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        td {
            padding: 6px 4px;
            font-size: 14px;
        }

        .label {
            font-weight: bold;
            width: 35%;
        }

        /* Estado */
        .estado-ok {
            color: green;
            font-weight: bold;
        }

        .estado-off {
            color: red;
            font-weight: bold;
        }

        /* Firmas */
        .firmas {
            margin-top: 60px;
            width: 100%;
        }

        .firma-box {
            width: 45%;
            text-align: center;
            display: inline-block;
            margin-top: 40px;
        }

        .firma-line {
            border-top: 1px solid #000;
            margin-top: 50px;
            padding-top: 5px;
            font-size: 14px;
        }

    </style>
</head>
<body>

<div class="page">

    <div class="header">
        <img src="{{ public_path('img/escudo.png') }}" alt="Escudo">
        <div class="title">Legajo Oficial del Personal</div>
    </div>

    <div class="foto">
        @if($user->photo)
            <img src="{{ public_path('uploads/photos/'.$user->photo) }}">
        @else
            <img src="{{ public_path('img/default-user.png') }}">
        @endif
    </div>

    <!-- DATOS PERSONALES -->
    <div class="section-title">Datos Personales</div>
    <table>
        <tr>
            <td class="label">Nombre completo:</td>
            <td>{{ $user->name }} {{ $user->last_name }}</td>
        </tr>
        <tr>
            <td class="label">DNI:</td>
            <td>{{ $user->dni ?: '—' }}</td>
        </tr>
        <tr>
            <td class="label">Fecha de nacimiento:</td>
            <td>{{ $user->birthdate ?: '—' }}</td>
        </tr>
        <tr>
            <td class="label">Dirección:</td>
            <td>{{ $user->address ?: '—' }}</td>
        </tr>
    </table>

    <!-- INSTITUCIONAL -->
    <div class="section-title">Información Institucional</div>
    <table>
        <tr>
            <td class="label">Jerarquía:</td>
            <td>{{ $user->hierarchy->name ?? 'Sin jerarquía' }}</td>
        </tr>

        <tr>
            <td class="label">Número de Legajo:</td>
            <td>{{ $user->legajo_number ?: '—' }}</td>
        </tr>

        <tr>
            <td class="label">Fecha de ingreso:</td>
            <td>{{ $user->ingreso_date ?: '—' }}</td>
        </tr>

        <tr>
            <td class="label">Estado:</td>
            <td>
                @if($user->enabled)
                    <span class="estado-ok">HABILITADO</span>
                @else
                    <span class="estado-off">DESHABILITADO</span>
                @endif
            </td>
        </tr>
    </table>

    <!-- CONTACTO -->
    <div class="section-title">Datos de Contacto</div>
    <table>
        <tr>
            <td class="label">Email:</td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="label">Teléfono:</td>
            <td>{{ $user->phone ?: '—' }}</td>
        </tr>
    </table>

    <!-- FIRMAS -->
    <div class="firmas">
        <div class="firma-box">
            <div class="firma-line">Firma del Jefe del Cuerpo</div>
        </div>

        <div class="firma-box" style="float:right;">
            <div class="firma-line">Firma del Personal</div>
        </div>
    </div>

</div>

</body>
</html>
