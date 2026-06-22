@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Componente</h2>

    <form method="POST" action="{{ route('components.update', $component) }}">
        @csrf
        @method('PUT')

        <input type="text" name="code" value="{{ $component->code }}" class="form-control mb-2">
        <input type="text" name="name" value="{{ $component->name }}" class="form-control mb-2">
        <input type="text" name="type" value="{{ $component->type }}" class="form-control mb-2">

        <select name="status" class="form-control mb-2">
            <option value="disponible" @selected($component->status=='disponible')>Disponible</option>
            <option value="instalado" @selected($component->status=='instalado')>Instalado</option>
            <option value="dado_de_baja" @selected($component->status=='dado_de_baja')>Baja</option>
        </select>

        <button class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection