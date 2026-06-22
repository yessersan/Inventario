@extends('layouts.admin')

@section('content')

<div class="card">

<div class="card-header">

<h3>Nuevo Departamento</h3>

</div>

<div class="card-body">

<form action="{{route('departments.store')}}" method="POST">

@csrf

<div class="mb-3">

<label>Nombre</label>

<input type="text"

name="name"

value="{{old('name')}}"

class="form-control">

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea name="description"

class="form-control">{{old('description')}}</textarea>

</div>

<button class="btn btn-success">

Guardar

</button>

<a href="{{route('departments.index')}}"

class="btn btn-secondary">

Volver

</a>

</form>

</div>

</div>

@endsection