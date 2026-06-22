@extends('layouts.app')

@section('content')

<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Gestión de Ubicaciones</h2>

<a href="{{ route('locations.create') }}" class="btn btn-primary">

Nueva Ubicación

</a>

</div>

@if(session('success'))

<div class="alert alert-success">

{{ session('success') }}

</div>

@endif

<table class="table table-bordered table-hover">

<thead class="table-dark">

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Descripción</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

@forelse($locations as $location)

<tr>

<td>{{ $location->id }}</td>

<td>{{ $location->name }}</td>

<td>{{ $location->description }}</td>

<td>

<a
href="{{ route('locations.show',$location) }}"
class="btn btn-info btn-sm">

Ver

</a>

<a
href="{{ route('locations.edit',$location) }}"
class="btn btn-warning btn-sm">

Editar

</a>

<form
action="{{ route('locations.destroy',$location) }}"
method="POST"
style="display:inline">

@csrf

@method('DELETE')

<button
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar ubicación?')">

Eliminar

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="4">

No existen registros

</td>

</tr>

@endforelse

</tbody>

</table>

{{ $locations->links() }}

</div>

@endsection