<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Inventario</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 20px;
            margin: 0;
            color: #2c3e50;
        }
        .header p {
            margin: 5px 0 0;
            color: #666;
            font-size: 11px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #34495e;
            color: #fff;
            padding: 8px 10px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
        }
        td {
            padding: 6px 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .badge-success {
            background-color: #28a745;
            color: #fff;
        }
        .badge-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #000;
        }
        .text-center {
            text-align: center;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📋 Reporte de Inventario Actual</h1>
        <p>Generado: {{ date('d/m/Y H:i:s') }}</p>
        <p>Total de equipos: {{ $equipment->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Estado</th>
                <th>Ubicación</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @forelse($equipment as $eq)
                <tr>
                    <td>{{ $eq->code }}</td>
                    <td>{{ $eq->name }}</td>
                    <td>{{ $eq->type ?? 'N/A' }}</td>
                    <td>{{ $eq->brand ?? 'N/A' }}</td>
                    <td>{{ $eq->model ?? 'N/A' }}</td>
                    <td>{{ $eq->serial_number ?? 'N/A' }}</td>
                    <td>
                        @php
                            $badgeClass = $eq->status == 'dado_de_baja' ? 'badge-danger' : 'badge-success';
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($eq->status) }}</span>
                    </td>
                    <td>{{ $eq->location->name ?? 'Sin ubicación' }}</td>
                    <td>{{ $eq->responsible->name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No hay equipos registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Este reporte fue generado automáticamente por el Sistema de Inventario</p>
        <p>Página 1 de 1</p>
    </div>
</body>
</html>