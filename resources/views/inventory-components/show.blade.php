@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Componente</h2>

    <ul class="list-group">
        <li class="list-group-item"><b>Código:</b> {{ $component->code }}</li>
        <li class="list-group-item"><b>Nombre:</b> {{ $component->name }}</li>
        <li class="list-group-item"><b>Tipo:</b> {{ $component->type }}</li>
        <li class="list-group-item"><b>Estado:</b> {{ $component->status }}</li>
        <li class="list-group-item"><b>Equipo:</b> {{ $component->equipment->name ?? '-' }}</li>
    </ul>

    <a href="{{ route('components.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection