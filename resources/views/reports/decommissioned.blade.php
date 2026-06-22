@extends('layouts.app')

@section('title', 'Equipos Dados de Baja')
@section('page-title', 'Listado de Equipos de Baja')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('reports.export', ['type' => 'decommissioned']) }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar Excel</a>
                        <a href="{{ route('reports.pdf', ['type' => 'decommissioned']) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar PDF</a>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('reports.decommissioned') }}" class="row g-3 align-items-end">
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
                            <a href="{{ route('reports.decommissioned') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-undo"></i> Limpiar</a>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Serie</th>
                                <th>Ubicación</th>
                                <th>Fecha de baja (aprox.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($equipment as $eq)
                                <tr>
                                    <td>{{ $eq->code }}</td>
                                    <td>{{ $eq->name }}</td>
                                    <td>{{ $eq->type }}</td>
                                    <td>{{ $eq->serial_number ?? 'N/A' }}</td>
                                    <td>{{ $eq->location->name ?? 'Sin ubicación' }}</td>
                                    <td>{{ $eq->updated_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay equipos dados de baja.</td>
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