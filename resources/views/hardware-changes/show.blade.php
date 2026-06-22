@extends('layouts.app')

@section('title', 'Detalle Cambio de Hardware')
@section('page-title', 'Cambio de Hardware')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Equipo:</strong> {{ $hardwareChange->equipment->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Tipo:</strong>
                        @php
                            $badge = match($hardwareChange->change_type) {
                                'modificacion' => 'bg-secondary',
                                'reemplazo' => 'bg-warning',
                                'repotenciación' => 'bg-success',
                                default => 'bg-info'
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ ucfirst($hardwareChange->change_type) }}</span>
                    </div>
                    <div class="col-12">
                        <strong>Descripción:</strong> {{ $hardwareChange->description }}
                    </div>
                    <div class="col-md-4">
                        <strong>Fecha:</strong> {{ $hardwareChange->date->format('d/m/Y') }}
                    </div>
                    <div class="col-md-4">
                        <strong>Responsable:</strong> {{ $hardwareChange->responsible->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Componente viejo:</strong> {{ $hardwareChange->oldComponent->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Componente nuevo:</strong> {{ $hardwareChange->newComponent->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-8">
                        <strong>Notas:</strong> {{ $hardwareChange->notes ?? 'Sin notas' }}
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('hardware-changes.edit', $hardwareChange) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                    <a href="{{ route('hardware-changes.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection