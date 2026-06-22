@extends('layouts.admin')

@section('content')

<div class="d-flex justify-content-between mb-4">

<h2>Departamentos</h2>

<a href="{{route('departments.create')}}" class="btn btn-primary">

Nuevo Departamento

</a>

</div>

<div class="card">

<div class="card-body">

<table class="table table-hover">

<thead>

<tr>

<th>ID</th>

<th>Nombre</th>

<th>Descripción</th>

<th>Acciones</th>

</tr>

</thead>

<tbody>

@foreach($departments as $department)

<tr>

<td>{{$department->id}}</td>

<td>{{$department->name}}</td>

<td>{{$department->description}}</td>

<td>

<a href="{{route('departments.show',$department)}}" class="btn btn-info btn-sm">

Ver

</a>

<a href="{{route('departments.edit',$department)}}" class="btn btn-warning btn-sm">

Editar

</a>

<form action="{{route('departments.destroy',$department)}}" method="POST" class="d-inline">

@csrf

@method('DELETE')

<button class="btn btn-danger btn-sm">

Eliminar

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

{{$departments->links()}}

</div>

</div>

@endsection