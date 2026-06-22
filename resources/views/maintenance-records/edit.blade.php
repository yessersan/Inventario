@extends('layouts.app')

@section('title', 'Editar Mantenimiento')
@section('page-title', 'Editar Registro de Mantenimiento')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('maintenance-records.update', $maintenanceRecord) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="equipment_id" class="form-label">Equipo <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment_id" class="form-select @error('equipment_id') is-invalid @enderror" required>
                                @foreach($equipment as $eq)
                                    <option value="{{ $eq->id }}" {{ old('equipment_id', $maintenanceRecord->equipment_id) == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="preventivo" {{ old('type', $maintenanceRecord->type) == 'preventivo' ? 'selected' : '' }}>Preventivo</option>
                                <option value="correctivo" {{ old('type', $maintenanceRecord->type) == 'correctivo' ? 'selected' : '' }}>Correctivo</option>
                                <option value="repotenciación" {{ old('type', $maintenanceRecord->type) == 'repotenciación' ? 'selected' : '' }}>Repotenciación</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Descripción <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $maintenanceRecord->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="date" class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $maintenanceRecord->date->format('Y-m-d')) }}" required>
                            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="next_maintenance" class="form-label">Próximo mantenimiento</label>
                            <input type="date" name="next_maintenance" id="next_maintenance" class="form-control @error('next_maintenance') is-invalid @enderror" value="{{ old('next_maintenance', $maintenanceRecord->next_maintenance ? $maintenanceRecord->next_maintenance->format('Y-m-d') : '') }}">
                            @error('next_maintenance') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="performed_by" class="form-label">Realizado por</label>
                            <select name="performed_by" id="performed_by" class="form-select @error('performed_by') is-invalid @enderror">
                                <option value="">Seleccione...</option>
                                @foreach($personnel as $p)
                                    <option value="{{ $p->id }}" {{ old('performed_by', $maintenanceRecord->performed_by) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('performed_by') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="cost" class="form-label">Costo</label>
                            <input type="number" step="0.01" name="cost" id="cost" class="form-control @error('cost') is-invalid @enderror" value="{{ old('cost', $maintenanceRecord->cost) }}" min="0">
                            @error('cost') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="notes" class="form-label">Notas</label>
                            <input type="text" name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" value="{{ old('notes', $maintenanceRecord->notes) }}">
                            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                            <a href="{{ route('maintenance-records.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection