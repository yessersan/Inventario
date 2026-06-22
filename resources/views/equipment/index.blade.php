@extends('layouts.app')

@section('content')

<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Gestión de Equipos</h2>

<a href="{{ route('equipment.create') }}" class="btn btn-primary">

Nuevo Equipo

</a>

</div>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<form method="GET" class="row g-3 mb-4">

<div class="col-md-3">

<input
type="text"
name="search"
class="form-control"
placeholder="Buscar"
value="{{ request('search') }}">

</div>

<div class="col-md-3">

<select name="status" class="form-control">

<option value="">Todos los estados</option>

<option value="activo">Activo</option>

<option value="en_mantenimiento">En mantenimiento</option>

<option value="dado_de_baja">Dado de baja</option>

</select>

</div>

<div class="col-md-3">

<select name="location_id" class="form-control">

<option value="">Todas las ubicaciones</option>

@foreach($locations as $location)

<option
value="{{ $location->id }}"
{{ request('location_id')==$location->id?'selected':'' }}>

{{ $location->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2">

<input
type="text"
name="type"
value="{{ request('type') }}"
placeholder="Tipo"
class="form-control">

</div>

<div class="col-md-1">

<button class="btn btn-success w-100">

OK

</button>

</div>

</form>

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>Código</th>

<th>Equipo</th>

<th>Tipo</th>

<th>Estado</th>

<th>Ubicación</th>

<th>Responsable</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

@forelse($equipment as $item)

<tr>

<td>{{ $item->code }}</td>

<td>{{ $item->name }}</td>

<td>{{ $item->type }}</td>

<td>{{ $item->status }}</td>

<td>{{ $item->location->name ?? '-' }}</td>

<td>{{ $item->responsible->name ?? '-' }}</td>

<td>

<a
href="{{ route('equipment.show',$item) }}"
class="btn btn-info btn-sm">

Ver

</a>

<a
href="{{ route('equipment.edit',$item) }}"
class="btn btn-warning btn-sm">

Editar

</a>

<form
action="{{ route('equipment.destroy',$item) }}"
method="POST"
style="display:inline">

@csrf

@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar equipo?')">

Eliminar

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="7">

No existen registros

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $equipment->links() }}

</div>

@endsection