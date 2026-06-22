@extends('layouts.app')

@section('content')

<div class="bg-white rounded-lg shadow p-6">

```
<div class="flex justify-between items-center mb-5">

    <h1 class="text-2xl font-bold">

        {{ $titulo }}

    </h1>

    <a href="{{ $rutaCrear }}"
       class="bg-blue-600 text-white px-4 py-2 rounded">

        Nuevo

    </a>

</div>

<table class="w-full border">

    <thead>

        <tr class="bg-gray-100">

            <th class="p-3 border">ID</th>

            <th class="p-3 border">Nombre</th>

            <th class="p-3 border">Acciones</th>

        </tr>

    </thead>

    <tbody>

        @foreach($datos as $dato)

        <tr>

            <td class="border p-3">
                {{ $dato->id }}
            </td>

            <td class="border p-3">
                {{ $dato->name ?? '-' }}
            </td>

            <td class="border p-3">

                <a href="#" class="text-blue-600">

                    Ver

                </a>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>
```

</div>

@endsection
