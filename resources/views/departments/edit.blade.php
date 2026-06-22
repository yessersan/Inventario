@extends('layouts.admin')

@section('content')

<div class="card">

<div class="card-header">

<h3>Editar Departamento</h3>

</div>

<div class="card-body">

<form action="{{route('departments.update',$department)}}" method="POST">

@csrf

@method('PUT')

<div class="mb-3">

<label>Nombre</label>

<input type="text"

name="name"

value="{{$department->name}}"

class="form-control">

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea name="description"

class="form-control">{{$department->description}}</textarea>

</div>

<button class="btn btn-primary">

Actualizar

</button>

<a href="{{route('departments.index')}}"

class="btn btn-secondary">

Volver

</a>

</form>

</div>

</div>

@endsection