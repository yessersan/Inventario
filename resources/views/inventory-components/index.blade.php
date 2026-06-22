@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inventario de Componentes</h2>

    <a href="{{ route('components.create') }}" class="btn btn-primary mb-3">
        Nuevo Componente
    </a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>Equipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($components as $component)
            <tr>
                <td>{{ $component->code }}</td>
                <td>{{ $component->name }}</td>
                <td>{{ $component->type }}</td>
                <td>{{ $component->status }}</td>
                <td>{{ $component->equipment->name ?? '-' }}</td>
                <td>
                    <a href="{{ route('components.show', $component) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('components.edit', $component) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('components.destroy', $component) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $components->links() }}
</div>
@endsection