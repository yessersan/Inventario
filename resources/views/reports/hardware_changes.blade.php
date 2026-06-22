@extends('layouts.app')

@section('title', 'Reporte de Cambios de Hardware')
@section('page-title', 'Historial de Cambios de Hardware')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <a href="{{ route('reports.export', ['type' => 'hardware_changes']) }}" class="btn btn-success"><i class="fas fa-file-excel"></i> Exportar Excel</a>
                        <a href="{{ route('reports.pdf', ['type' => 'hardware_changes']) }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i> Exportar PDF</a>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('reports.hardware_changes') }}" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="from_date" class="form-label">Desde</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="to_date" class="form-label">Hasta</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="change_type" class="form-label">Tipo</label>
                            <select name="change_type" id="change_type" class="form-select">
                                <option value="">Todos</option>
                                <option value="modificacion" {{ request('change_type') == 'modificacion' ? 'selected' : '' }}>Modificación</option>
                                <option value="reemplazo" {{ request('change_type') == 'reemplazo' ? 'selected' : '' }}>Reemplazo</option>
                                <option value="repotenciación" {{ request('change_type') == 'repotenciación' ? 'selected' : '' }}>Repotenciación</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Filtrar</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('reports.hardware_changes') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-undo"></i> Limpiar</a>
                        </div>
                    </form>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Responsable</th>
                                <th>Componente viejo</th>
                                <th>Componente nuevo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($changes as $change)
                                <tr>
                                    <td>{{ $change->equipment->name ?? 'N/A' }}</td>
                                    <td><span class="badge bg-secondary">{{ ucfirst($change->change_type) }}</span></td>
                                    <td>{{ Str::limit($change->description, 40) }}</td>
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
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span>Mostrando {{ $changes->firstItem() ?? 0 }} - {{ $changes->lastItem() ?? 0 }} de {{ $changes->total() }}</span>
                    {{ $changes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection