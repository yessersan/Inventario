@extends('layouts.app')

@section('title', 'Cambios de Hardware')
@section('page-title', 'Historial de Cambios de Hardware')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('hardware-changes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Nuevo Cambio
                    </a>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('hardware-changes.index') }}" class="row g-3 align-items-end">
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
                            <label for="change_type" class="form-label">Tipo</label>
                            <select name="change_type" id="change_type" class="form-select">
                                <option value="">Todos</option>
                                <option value="modificacion" {{ request('change_type') == 'modificacion' ? 'selected' : '' }}>Modificación</option>
                                <option value="reemplazo" {{ request('change_type') == 'reemplazo' ? 'selected' : '' }}>Reemplazo</option>
                                <option value="repotenciación" {{ request('change_type') == 'repotenciación' ? 'selected' : '' }}>Repotenciación</option>
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
                                <th>Responsable</th>
                                <th>Componente viejo</th>
                                <th>Componente nuevo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($changes as $change)
                                <tr>
                                    <td>{{ $change->equipment->name ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $badge = match($change->change_type) {
                                                'modificacion' => 'bg-secondary',
                                                'reemplazo' => 'bg-warning',
                                                'repotenciación' => 'bg-success',
                                                default => 'bg-info'
                                            };
                                        @endphp
                                        <span class="badge {{ $badge }}">{{ ucfirst($change->change_type) }}</span>
                                    </td>
                                    <td>{{ Str::limit($change->description, 40) }}</td>
                                    <td>{{ $change->date->format('d/m/Y') }}</td>
                                    <td>{{ $change->responsible->name ?? 'N/A' }}</td>
                                    <td>{{ $change->oldComponent->name ?? 'N/A' }}</td>
                                    <td>{{ $change->newComponent->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('hardware-changes.show', $change) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('hardware-changes.edit', $change) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('hardware-changes.destroy', $change) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay registros de cambios.</td>
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