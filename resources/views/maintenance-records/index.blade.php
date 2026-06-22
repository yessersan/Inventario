@extends('layouts.app')

@section('title', 'Mantenimientos')
@section('page-title', 'Historial de Mantenimientos')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('maintenance-records.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Nuevo Mantenimiento
                    </a>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('maintenance-records.index') }}" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="equipment_id" class="form-label">Equipo</label>
                            <select name="equipment_id" id="equipment_id" class="form-select">
                                <option value="">Todos</option>
                                @foreach($equipment as $eq)
                                    <option value="{{ $eq->id }}" {{ request('equipment_id') == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="type" class="form-label">Tipo</label>
                            <select name="type" id="type" class="form-select">
                                <option value="">Todos</option>
                                <option value="preventivo" {{ request('type') == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                                <option value="correctivo" {{ request('type') == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                                <option value="repotenciación" {{ request('type') == 'repotenciación' ? 'selected' : '' }}>Repotenciación</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="from_date" class="form-label">Desde</label>
                            <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="to_date" class="form-label">Hasta</label>
                            <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Filtrar</button>
                        </div>
                    </form>
                </div>

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>Tipo</th>
                                <th>Descripción</th>
                                <th>Fecha</th>
                                <th>Próximo</th>
                                <th>Realizado por</th>
                                <th>Costo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($records as $record)
                                <tr>
                                    <td>{{ $record->equipment->name ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $badge = match($record->type) {
                                                'preventivo' => 'bg-info',
                                                'correctivo' => 'bg-warning',
                                                'repotenciación' => 'bg-success',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ ucfirst($record->type) }}</span>
                                    </td>
                                    <td>{{ Str::limit($record->description, 40) }}</td>
                                    <td>{{ $record->date->format('d/m/Y') }}</td>
                                    <td>{{ $record->next_maintenance ? $record->next_maintenance->format('d/m/Y') : 'N/A' }}</td>
                                    <td>{{ $record->performedBy->name ?? 'N/A' }}</td>
                                    <td>${{ number_format($record->cost, 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('maintenance-records.show', $record) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('maintenance-records.edit', $record) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('maintenance-records.destroy', $record) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay registros de mantenimiento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span>Mostrando {{ $records->firstItem() ?? 0 }} - {{ $records->lastItem() ?? 0 }} de {{ $records->total() }}</span>
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection