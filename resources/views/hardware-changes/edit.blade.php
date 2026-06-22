@extends('layouts.app')

@section('title', 'Editar Cambio de Hardware')
@section('page-title', 'Editar Cambio de Hardware')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('hardware-changes.update', $hardwareChange) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="equipment_id" class="form-label">Equipo <span class="text-danger">*</span></label>
                            <select name="equipment_id" id="equipment_id" class="form-select @error('equipment_id') is-invalid @enderror" required>
                                @foreach($equipment as $eq)
                                    <option value="{{ $eq->id }}" {{ old('equipment_id', $hardwareChange->equipment_id) == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="change_type" class="form-label">Tipo <span class="text-danger">*</span></label>
                            <select name="change_type" id="change_type" class="form-select @error('change_type') is-invalid @enderror" required>
                                <option value="modificacion" {{ old('change_type', $hardwareChange->change_type) == 'modificacion' ? 'selected' : '' }}>Modificación</option>
                                <option value="reemplazo" {{ old('change_type', $hardwareChange->change_type) == 'reemplazo' ? 'selected' : '' }}>Reemplazo</option>
                                <option value="repotenciación" {{ old('change_type', $hardwareChange->change_type) == 'repotenciación' ? 'selected' : '' }}>Repotenciación</option>
                            </select>
                            @error('change_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label for="description" class="form-label">Descripción <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" rows="3" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $hardwareChange->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="date" class="form-label">Fecha <span class="text-danger">*</span></label>
                            <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date', $hardwareChange->date->format('Y-m-d')) }}" required>
                            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="responsible_id" class="form-label">Responsable</label>
                            <select name="responsible_id" id="responsible_id" class="form-select @error('responsible_id') is-invalid @enderror">
                                <option value="">Seleccione...</option>
                                @foreach($personnel as $p)
                                    <option value="{{ $p->id }}" {{ old('responsible_id', $hardwareChange->responsible_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                @endforeach
                            </select>
                            @error('responsible_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="old_component_id" class="form-label">Componente viejo</label>
                            <select name="old_component_id" id="old_component_id" class="form-select @error('old_component_id') is-invalid @enderror">
                                <option value="">Ninguno</option>
                                @foreach($components as $c)
                                    <option value="{{ $c->id }}" {{ old('old_component_id', $hardwareChange->old_component_id) == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->code }})</option>
                                @endforeach
                            </select>
                            @error('old_component_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="new_component_id" class="form-label">Componente nuevo</label>
                            <select name="new_component_id" id="new_component_id" class="form-select @error('new_component_id') is-invalid @enderror">
                                <option value="">Ninguno</option>
                                @foreach($components as $c)
                                    <option value="{{ $c->id }}" {{ old('new_component_id', $hardwareChange->new_component_id) == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->code }})</option>
                                @endforeach
                            </select>
                            @error('new_component_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label">Notas</label>
                            <input type="text" name="notes" id="notes" class="form-control @error('notes') is-invalid @enderror" value="{{ old('notes', $hardwareChange->notes) }}">
                            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                            <a href="{{ route('hardware-changes.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection