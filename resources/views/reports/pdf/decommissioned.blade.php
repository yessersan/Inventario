<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Equipos Dados de Baja</title>
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
            background-color: #c0392b;
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
            background-color: #c0392b;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>📦 Equipos Dados de Baja</h1>
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
                <th>Ubicación</th>
                <th>Fecha de Baja</th>
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
                    <td>{{ $eq->location->name ?? 'Sin ubicación' }}</td>
                    <td>{{ $eq->updated_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No hay equipos dados de baja.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Este reporte fue generado automáticamente por el Sistema de Inventario</p>
    </div>
</body>
</html>