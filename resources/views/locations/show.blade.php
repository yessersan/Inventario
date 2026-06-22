@extends('layouts.app')

@section('content')

<div class="container">

<h2>Detalle de la Ubicación</h2>

<div class="card">

<div class="card-body">

<p>

<strong>ID:</strong>

{{ $location->id }}

</p>

<p>

<strong>Nombre:</strong>

{{ $location->name }}

</p>

<p>

<strong>Descripción:</strong>

{{ $location->description }}

</p>

<p>

<strong>Total de equipos:</strong>

{{ $location->equipment->count() }}

</p>

</div>

</div>

@if($location->equipment->count())

<div class="card mt-4">

<div class="card-header">

Equipos asociados

</div>

<div class="card-body">

<table class="table">

<thead>

<tr>

<th>Código</th>

<th>Equipo</th>

<th>Estado</th>

</tr>

</thead>

<tbody>

@foreach($location->equipment as $equipment)

<tr>

<td>{{ $equipment->code }}</td>

<td>{{ $equipment->name }}</td>

<td>{{ $equipment->status }}</td>

</tr>

@endforeach

</tbody>

</table>

</div>

</div>

@endif

<a
href="{{ route('locations.index') }}"
class="btn btn-secondary mt-3">

Volver

</a>

</div>

@endsection