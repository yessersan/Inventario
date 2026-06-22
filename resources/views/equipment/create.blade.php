@extends('layouts.app')

@section('content')

<div class="container">

<h2>Registrar Equipo</h2>

<form action="{{ route('equipment.store') }}" method="POST">

@csrf

<div class="row">

<div class="col-md-6 mb-3">

<label>Código</label>

<input
type="text"
name="code"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Nombre</label>

<input
type="text"
name="name"
class="form-control"
required>

</div>

<div class="col-md-4 mb-3">

<label>Tipo</label>

<input
type="text"
name="type"
class="form-control"
required>

</div>

<div class="col-md-4 mb-3">

<label>Marca</label>

<input
type="text"
name="brand"
class="form-control">

</div>

<div class="col-md-4 mb-3">

<label>Modelo</label>

<input
type="text"
name="model"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>N° Serie</label>

<input
type="text"
name="serial_number"
class="form-control">

</div>

<div class="col-md-6 mb-3">

<label>Estado</label>

<select name="status" class="form-control">

<option value="activo">Activo</option>

<option value="en_mantenimiento">En mantenimiento</option>

<option value="dado_de_baja">Dado de baja</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Ubicación</label>

<select name="location_id" class="form-control">

<option value="">Seleccione</option>

@foreach($locations as $location)

<option value="{{ $location->id }}">

{{ $location->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Responsable</label>

<select name="responsible_id" class="form-control">

<option value="">Seleccione</option>

@foreach($personnel as $person)

<option value="{{ $person->id }}">

{{ $person->name }}

</option>

@endforeach

</select>

</div>

<div class="col-md-6 mb-3">

<label>Fecha ingreso</label>

<input
type="date"
name="entry_date"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Fin garantía</label>

<input
type="date"
name="warranty_end"
class="form-control">

</div>

<div class="col-md-12 mb-3">

<label>Notas</label>

<textarea
name="notes"
rows="4"
class="form-control"></textarea>

</div>

</div>

<button class="btn btn-primary">

Guardar

</button>

<a
href="{{ route('equipment.index') }}"
class="btn btn-secondary">

Cancelar

</a>

</form>

</div>

@endsection