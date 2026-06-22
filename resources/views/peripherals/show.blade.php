@extends('layouts.app')

@section('title', 'Detalle Periférico')
@section('page-title', 'Periférico: {{ $peripheral->name }}')

@section('content')
<div class="row">
    <div class="col-lg-10 offset-lg-1">
        <div class="card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Código:</strong> {{ $peripheral->code }}
                    </div>
                    <div class="col-md-6">
                        <strong>Nombre:</strong> {{ $peripheral->name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Tipo:</strong> {{ $peripheral->type }}
                    </div>
                    <div class="col-md-6">
                        <strong>Marca:</strong> {{ $peripheral->brand ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Modelo:</strong> {{ $peripheral->model ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Serie:</strong> {{ $peripheral->serial_number ?? 'N/A' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Estado:</strong>
                        @php
                            $badge = match($peripheral->status) {
                                'disponible' => 'bg-success',
                                'instalado' => 'bg-primary',
                                'dado_de_baja' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badge }} badge-status">{{ ucfirst($peripheral->status) }}</span>
                    </div>
                    <div class="col-md-6">
                        <strong>Ubicación:</strong> {{ $peripheral->location->name ?? 'Sin ubicación' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Equipo asignado:</strong> {{ $peripheral->equipment->name ?? 'No asignado' }}
                    </div>
                    <div class="col-md-6">
                        <strong>Fecha de ingreso:</strong> {{ $peripheral->entry_date->format('d/m/Y') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Fin de garantía:</strong> {{ $peripheral->warranty_end ? $peripheral->warranty_end->format('d/m/Y') : 'N/A' }}
                    </div>
                    <div class="col-12">
                        <strong>Notas:</strong> {{ $peripheral->notes ?? 'Sin notas' }}
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('peripherals.edit', $peripheral) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Editar</a>
                    <a href="{{ route('peripherals.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection