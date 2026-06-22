@extends('layouts.app')

@section('content')

<div class="container">

<h2>Editar Ubicación</h2>

<form
action="{{ route('locations.update',$location) }}"
method="POST">

@csrf

@method('PUT')

<div class="mb-3">

<label>Nombre</label>

<input
type="text"
name="name"
value="{{ $location->name }}"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Descripción</label>

<textarea
name="description"
class="form-control"
rows="4">{{ $location->description }}</textarea>

</div>

<button class="btn btn-success">

Actualizar

</button>

<a
href="{{ route('locations.index') }}"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

@endsection