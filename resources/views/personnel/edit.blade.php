@extends('layouts.app')

@section('content')

<div class="container">

<h2>Editar Personal</h2>

<form
action="{{ route('personnel.update',$personnel) }}"
method="POST">

@csrf

@method('PUT')

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="name"
value="{{ $personnel->name }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
value="{{ $personnel->email }}"
class="form-control">

</div>

<div class="mb-3">

<label>Departamento</label>

<select name="department_id" class="form-control">

<option value="">Seleccione</option>

@foreach($departments as $department)

<option
value="{{ $department->id }}"
{{ $personnel->department_id==$department->id?'selected':'' }}>

{{ $department->name }}

</option>

@endforeach

</select>

</div>

<button class="btn btn-success">

Actualizar

</button>

<a
href="{{ route('personnel.index') }}"
class="btn btn-secondary">

Volver

</a>

</form>

</div>

@endsection