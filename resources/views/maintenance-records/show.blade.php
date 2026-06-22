@extends('layouts.app')

@section('title', 'Detalle Mantenimiento')
@section('page-title', 'Registro de Mantenimiento')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Equipo:</strong> {{ $maintenanceRecord->equipment->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Tipo:</strong>
                        @php
                            $badge = match($maintenanceRecord->type) {
                                'preventivo' => 'bg-info',
                                'correctivo' => 'bg-warning',
                                'repotenciación' => 'bg-success',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badge }}">{{ ucfirst($maintenanceRecord->type) }}</span>
                    </div>
                    <div class="col-12">
                        <strong>Descripción:</strong> {{ $maintenanceRecord->description }}
                    </div>
                    <div class="col-md-4">
                        <strong>Fecha:</strong> {{ $maintenanceRecord->date->format('d/m/Y') }}
                    </div>
                    <div class="col-md-4">
                        <strong>Próximo mantenimiento:</strong> {{ $maintenanceRecord->next_maintenance ? $maintenanceRecord->next_maintenance->format('d/m/Y') : 'N/A' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Realizado por:</strong> {{ $maintenanceRecord->performedBy->name ?? 'N/A' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Costo:</strong> ${{ number_format($maintenanceRecord->cost, 2) }}
                    </div>
                    <div class="col-md-8">
                        <strong>Notas:</strong> {{ $maintenanceRecord->notes ?? 'Sin notas' }}
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('maintenance-records.edit', $maintenanceRecord) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                    <a href="{{ route('maintenance-records.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection