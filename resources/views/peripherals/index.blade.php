@extends('layouts.app')

@section('title', 'Periféricos')
@section('page-title', 'Listado de Periféricos')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('peripherals.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Nuevo Periférico
                    </a>
                </div>

                <!-- Filtros -->
                <div class="filter-section">
                    <form method="GET" action="{{ route('peripherals.index') }}" class="row g-3 align-items-end">
                        <div class="col-md-3">
                            <label for="search" class="form-label">Buscar</label>
                            <input type="text" name="search" id="search" class="form-control" placeholder="Código, nombre, serie..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label for="status" class="form-label">Estado</label>
                            <select name="status" id="status" class="form-select">
                                <option value="">Todos</option>
                                <option value="disponible" {{ request('status') == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="instalado" {{ request('status') == 'instalado' ? 'selected' : '' }}>Instalado</option>
                                <option value="dado_de_baja" {{ request('status') == 'dado_de_baja' ? 'selected' : '' }}>Dado de baja</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="equipment_id" class="form-label">Equipo asociado</label>
                            <select name="equipment_id" id="equipment_id" class="form-select">
                                <option value="">Todos</option>
                                @foreach($equipment as $eq)
                                    <option value="{{ $eq->id }}" {{ request('equipment_id') == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-secondary w-100"><i class="fas fa-search"></i> Filtrar</button>
                        </div>
                        <div class="col-md-2">
                            <a href="{{ route('peripherals.index') }}" class="btn btn-outline-secondary w-100"><i class="fas fa-undo"></i> Limpiar</a>
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
                                <th>Equipo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peripherals as $peripheral)
                                <tr>
                                    <td><strong>{{ $peripheral->code }}</strong></td>
                                    <td>{{ $peripheral->name }}</td>
                                    <td>{{ $peripheral->type }}</td>
                                    <td>{{ $peripheral->serial_number ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $badge = match($peripheral->status) {
                                                'disponible' => 'bg-success',
                                                'instalado' => 'bg-primary',
                                                'dado_de_baja' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $badge }} badge-status">{{ ucfirst($peripheral->status) }}</span>
                                    </td>
                                    <td>{{ $peripheral->location->name ?? 'Sin ubicación' }}</td>
                                    <td>{{ $peripheral->equipment->name ?? 'No asignado' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('peripherals.show', $peripheral) }}" class="btn btn-sm btn-info" title="Ver"><i class="fas fa-eye"></i></a>
                                            <a href="{{ route('peripherals.edit', $peripheral) }}" class="btn btn-sm btn-warning" title="Editar"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('peripherals.destroy', $peripheral) }}" method="POST" class="delete-form d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No hay periféricos registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span>Mostrando {{ $peripherals->firstItem() ?? 0 }} - {{ $peripherals->lastItem() ?? 0 }} de {{ $peripherals->total() }}</span>
                    {{ $peripherals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection