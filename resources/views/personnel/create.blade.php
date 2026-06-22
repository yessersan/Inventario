@extends('layouts.app')

@section('content')

<div class="container">

<h2>Registrar Personal</h2>

<form action="{{ route('personnel.store') }}" method="POST">

@csrf

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control">

</div>

<div class="mb-3">

<label>Departamento</label>

<select name="department_id" class="form-control">

<option value="">Seleccione</option>

@foreach($departments as $department)

<option value="{{ $department->id }}">

{{ $department->name }}

</option>

@endforeach

</select>

</div>

<button class="btn btn-primary">

Guardar

</button>

<a
href="{{ route('personnel.index') }}"
class="btn btn-secondary">

Volver

</a>

</form>

</div>

@endsection