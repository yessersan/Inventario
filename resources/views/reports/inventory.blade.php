@extends('layouts.app')

@section('title', 'Reporte de Inventario')
@section('page-title', 'Inventario Actual de Equipos')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('reports.export', ['type' => 'inventory']) }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar Excel</a>
                        <a href="{{ route('reports.pdf', ['type' => 'inventory']) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar PDF</a>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('reports.inventory') }}" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="location_id" class="form-label">Ubicación</label>
                            <select name="location_id" id="location_id" class="form-select">
                                <option value="">Todas</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ request('location_id') == $loc->id ? 'selected' : '' }}>{{ $loc->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Filtrar</button>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('reports.inventory') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-undo"></i> Limpiar</a>
                        </div>
                    </form>
                </div>

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Tipo</th>
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
                                    <td>{{ $eq->type }}</td>
                                    <td>{{ $eq->serial_number ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $badge = $eq->status == 'dado_de_baja' ? 'bg-danger' : 'bg-success';
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ ucfirst($eq->status) }}</span>
                                    </td>
                                    <td>{{ $eq->location->name ?? 'Sin ubicación' }}</td>
                                    <td>{{ $eq->responsible->name ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No hay equipos activos.</td>
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