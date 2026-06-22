@extends('layouts.app')

@section('content')

<div class="container">

<h2>Detalle del Personal</h2>

<div class="card">

<div class="card-body">

<p>

<strong>Nombre:</strong>

{{ $personnel->name }}

</p>

<p>

<strong>Email:</strong>

{{ $personnel->email }}

</p>

<p>

<strong>Departamento:</strong>

{{ $personnel->department->name ?? '-' }}

</p>

<p>

<strong>Equipos asignados:</strong>

{{ $personnel->equipmentResponsible->count() }}

</p>

<p>

<strong>Mantenimientos:</strong>

{{ $personnel->maintenancePerformed->count() }}

</p>

<p>

<strong>Cambios hardware:</strong>

{{ $personnel->hardwareChangesResponsible->count() }}

</p>

</div>

</div>

<a
href="{{ route('personnel.index') }}"
class="btn btn-secondary mt-3">

Volver

</a>

</div>

@endsection