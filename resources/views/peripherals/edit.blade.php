@extends('layouts.app')

@section('title', 'Editar Periférico')
@section('page-title', 'Editar Periférico: {{ $peripheral->name }}')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('peripherals.update', $peripheral) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="code" class="form-label">Código <span class="text-danger">*</span></label>
                            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $peripheral->code) }}" required>
                            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="name" class="form-label">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $peripheral->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="type" class="form-label">Tipo <span class="text-danger">*</span></label>
                            <input type="text" name="type" id="type" class="form-control @error('type') is-invalid @enderror" value="{{ old('type', $peripheral->type) }}" required>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="brand" class="form-label">Marca</label>
                            <input type="text" name="brand" id="brand" class="form-control @error('brand') is-invalid @enderror" value="{{ old('brand', $peripheral->brand) }}">
                            @error('brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Modelo</label>
                            <input type="text" name="model" id="model" class="form-control @error('model') is-invalid @enderror" value="{{ old('model', $peripheral->model) }}">
                            @error('model') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="serial_number" class="form-label">Número de Serie</label>
                            <input type="text" name="serial_number" id="serial_number" class="form-control @error('serial_number') is-invalid @enderror" value="{{ old('serial_number', $peripheral->serial_number) }}">
                            @error('serial_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="status" class="form-label">Estado <span class="text-danger">*</span></label>
                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
                                <option value="disponible" {{ old('status', $peripheral->status) == 'disponible' ? 'selected' : '' }}>Disponible</option>
                                <option value="instalado" {{ old('status', $peripheral->status) == 'instalado' ? 'selected' : '' }}>Instalado</option>
                                <option value="dado_de_baja" {{ old('status', $peripheral->status) == 'dado_de_baja' ? 'selected' : '' }}>Dado de baja</option>
                            </select>
                            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="location_id" class="form-label">Ubicación</label>
                            <select name="location_id" id="location_id" class="form-select @error('location_id') is-invalid @enderror">
                                <option value="">Sin ubicación</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id', $peripheral->location_id) == $location->id ? 'selected' : '' }}>{{ $location->name }}</option>
                                @endforeach
                            </select>
                            @error('location_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="equipment_id" class="form-label">Equipo asignado</label>
                            <select name="equipment_id" id="equipment_id" class="form-select @error('equipment_id') is-invalid @enderror">
                                <option value="">Sin equipo</option>
                                @foreach($equipment as $eq)
                                    <option value="{{ $eq->id }}" {{ old('equipment_id', $peripheral->equipment_id) == $eq->id ? 'selected' : '' }}>{{ $eq->name }}</option>
                                @endforeach
                            </select>
                            @error('equipment_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="entry_date" class="form-label">Fecha de ingreso <span class="text-danger">*</span></label>
                            <input type="date" name="entry_date" id="entry_date" class="form-control @error('entry_date') is-invalid @enderror" value="{{ old('entry_date', $peripheral->entry_date->format('Y-m-d')) }}" required>
                            @error('entry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="warranty_end" class="form-label">Fin de garantía</label>
                            <input type="date" name="warranty_end" id="warranty_end" class="form-control @error('warranty_end') is-invalid @enderror" value="{{ old('warranty_end', $peripheral->warranty_end ? $peripheral->warranty_end->format('Y-m-d') : '') }}">
                            @error('warranty_end') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12">
                            <label for="notes" class="form-label">Notas</label>
                            <textarea name="notes" id="notes" rows="3" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $peripheral->notes) }}</textarea>
                            @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Actualizar</button>
                            <a href="{{ route('peripherals.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection