<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cambios de Hardware</title>
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
            background-color: #8e44ad;
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
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            background-color: #8e44ad;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🔄 Historial de Cambios de Hardware</h1>
        <p>Generado: {{ date('d/m/Y H:i:s') }}</p>
        <p>Total de cambios: {{ $changes->count() }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Tipo</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Responsable</th>
                <th>Componente Viejo</th>
                <th>Componente Nuevo</th>
            </tr>
        </thead>
        <tbody>
            @forelse($changes as $change)
                <tr>
                    <td>{{ $change->equipment->name ?? 'N/A' }}</td>
                    <td><span class="badge">{{ ucfirst($change->change_type) }}</span></td>
                    <td>{{ $change->description }}</td>
                    <td>{{ $change->date->format('d/m/Y') }}</td>
                    <td>{{ $change->responsible->name ?? 'N/A' }}</td>
                    <td>{{ $change->oldComponent->name ?? 'N/A' }}</td>
                    <td>{{ $change->newComponent->name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No hay cambios registrados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Este reporte fue generado automáticamente por el Sistema de Inventario</p>
    </div>
</body>
</html>