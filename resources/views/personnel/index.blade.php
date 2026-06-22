@extends('layouts.app')

@section('content')

<div class="container">

<h2>Personal</h2>

<a href="{{ route('personnel.create') }}" class="btn btn-primary mb-3">
Nuevo Personal
</a>

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>

@endif

<form method="GET" class="row mb-3">

<div class="col-md-5">

<input
type="text"
name="search"
class="form-control"
placeholder="Buscar"
value="{{ request('search') }}">

</div>

<div class="col-md-5">

<select name="department_id" class="form-control">

<option value="">Todos</option>

@foreach($departments as $department)

<option
value="{{ $department->id }}"
{{ request('department_id')==$department->id?'selected':'' }}>

{{ $department->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-2">

<button class="btn btn-success w-100">

Filtrar

</button>

</div>

</form>

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>Nombre</th>

<th>Email</th>

<th>Departamento</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

@foreach($personnel as $item)

<tr>

<td>{{ $item->name }}</td>

<td>{{ $item->email }}</td>

<td>{{ $item->department->name ?? '-' }}</td>

<td>

<a
href="{{ route('personnel.show',$item) }}"
class="btn btn-info btn-sm">

Ver

</a>

<a
href="{{ route('personnel.edit',$item) }}"
class="btn btn-warning btn-sm">

Editar

</a>

<form
action="{{ route('personnel.destroy',$item) }}"
method="POST"
style="display:inline">

@csrf

@method('DELETE')

<button
onclick="return confirm('Eliminar registro?')"
class="btn btn-danger btn-sm">

Eliminar

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

{{ $personnel->links() }}

</div>

@endsection