@extends('layouts.app')

@section('content')

<div class="container">

<h2>Detalle del Equipo</h2>

<div class="card">

<div class="card-body">

<p><strong>Código:</strong> {{ $equipment->code }}</p>

<p><strong>Nombre:</strong> {{ $equipment->name }}</p>

<p><strong>Tipo:</strong> {{ $equipment->type }}</p>

<p><strong>Marca:</strong> {{ $equipment->brand }}</p>

<p><strong>Modelo:</strong> {{ $equipment->model }}</p>

<p><strong>Serie:</strong> {{ $equipment->serial_number }}</p>

<p><strong>Estado:</strong> {{ $equipment->status }}</p>

<p><strong>Ubicación:</strong>

{{ $equipment->location->name ?? '-' }}

</p>

<p><strong>Responsable:</strong>

{{ $equipment->responsible->name ?? '-' }}

</p>

<p><strong>Fecha ingreso:</strong>

{{ $equipment->entry_date }}

</p>

<p><strong>Garantía:</strong>

{{ $equipment->warranty_end }}

</p>

<p><strong>Notas:</strong>

{{ $equipment->notes }}

</p>

</div>

</div>

<div class="row mt-4">

<div class="col-md-6">

<div class="card">

<div class="card-header">

Componentes

</div>

<div class="card-body">

<ul>

@foreach($equipment->components as $component)

<li>

{{ $component->name }}

</li>

@endforeach

</ul>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card">

<div class="card-header">

Periféricos

</div>

<div class="card-body">

<ul>

@foreach($equipment->peripherals as $peripheral)

<li>

{{ $peripheral->name }}

</li>

@endforeach

</ul>

</div>

</div>

</div>

</div>

<a
href="{{ route('equipment.index') }}"
class="btn btn-secondary mt-3">

Volver

</a>

</div>

@endsection