@extends('layouts.app')

@section('title', 'Equipos Repotenciados')
@section('page-title', 'Equipos con Mantenimiento de Repotenciación')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('reports.export', ['type' => 'repowered']) }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar Excel</a>
                        <a href="{{ route('reports.pdf', ['type' => 'repowered']) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar PDF</a>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('reports.repowered') }}" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="from_date" class="form-label">Desde</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="to_date" class="form-label">Hasta</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Filtrar</button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('reports.repowered') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-undo"></i> Limpiar</a>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>Código</th>
                                <th>Fecha de repotenciación</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipment as $eq)
                                @foreach($eq->maintenanceRecords as $record)
                                    <tr>
                                        <td>{{ $eq->name }}</td>
                                        <td>{{ $eq->code }}</td>
                                        <td>{{ $record->date->format('d/m/Y') }}</td>
                                        <td>{{ $record->description }}</td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay equipos repotenciados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span>Mostrando {{ $equipment->firstItem() ?? 0 }} - {{ $equipment->lastItem() ?? 0 }} de {{ $equipment->total() }}</span>
                    {{ $equipment->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection