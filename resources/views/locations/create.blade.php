@extends('layouts.app')

@section('content')

<div class="container">

<h2>Nueva Ubicación</h2>

<form action="{{ route('locations.store') }}" method="POST">

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

<label>Descripción</label>

<textarea
name="description"
class="form-control"
rows="4"></textarea>

</div>

<button class="btn btn-primary">

Guardar

</button>

<a
href="{{ route('locations.index') }}"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

@endsection