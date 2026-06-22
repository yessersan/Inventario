@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Nuevo Componente</h2>

    <form method="POST" action="{{ route('components.store') }}">
        @csrf

        <input type="text" name="code" class="form-control mb-2" placeholder="Código">
        <input type="text" name="name" class="form-control mb-2" placeholder="Nombre">
        <input type="text" name="type" class="form-control mb-2" placeholder="Tipo">
        <input type="text" name="brand" class="form-control mb-2" placeholder="Marca">
        <input type="text" name="model" class="form-control mb-2" placeholder="Modelo">
        <input type="text" name="serial_number" class="form-control mb-2" placeholder="Serie">

        <select name="status" class="form-control mb-2">
            <option value="disponible">Disponible</option>
            <option value="instalado">Instalado</option>
            <option value="dado_de_baja">Dado de baja</option>
        </select>

        <select name="location_id" class="form-control mb-2">
            <option value="">Ubicación</option>
            @foreach($locations as $loc)
                <option value="{{ $loc->id }}">{{ $loc->name }}</option>
            @endforeach
        </select>

        <select name="equipment_id" class="form-control mb-2">
            <option value="">Equipo</option>
            @foreach($equipment as $eq)
                <option value="{{ $eq->id }}">{{ $eq->name }}</option>
            @endforeach
        </select>

        <input type="date" name="entry_date" class="form-control mb-2">

        <button class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection