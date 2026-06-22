@extends('layouts.admin')

@section('content')

<div class="card">

<div class="card-header">

<h3>Detalle del Departamento</h3>

</div>

<div class="card-body">

<div class="mb-3">

<strong>ID:</strong>

{{$department->id}}

</div>

<div class="mb-3">

<strong>Nombre:</strong>

{{$department->name}}

</div>

<div class="mb-3">

<strong>Descripción:</strong>

{{$department->description}}

</div>

<div class="mb-3">

<strong>Fecha creación:</strong>

{{$department->created_at}}

</div>

<div class="mb-3">

<strong>Última actualización:</strong>

{{$department->updated_at}}

</div>

<a href="{{route('departments.edit',$department)}}"

class="btn btn-warning">

Editar

</a>

<a href="{{route('departments.index')}}"

class="btn btn-secondary">

Volver

</a>

</div>

</div>

@endsection