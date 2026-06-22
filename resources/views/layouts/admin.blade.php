<!DOCTYPE html>
<html lang="es">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Sistema de Inventario</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>

body{
margin:0;
background:#f4f6f9;
font-family:Arial,sans-serif;
}

.sidebar{
width:260px;
height:100vh;
position:fixed;
background:#0f172a;
overflow:auto;
padding:20px;
}

.logo{
color:#fff;
font-size:25px;
font-weight:bold;
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:12px;
margin-bottom:8px;
text-decoration:none;
color:#fff;
border-radius:10px;
}

.sidebar a:hover{
background:#1e293b;
}

.main{
margin-left:260px;
padding:25px;
}

.topbar{
background:#fff;
padding:15px;
border-radius:10px;
box-shadow:0 0 10px rgba(0,0,0,.1);
margin-bottom:25px;
}

.card{
border:none;
box-shadow:0 0 10px rgba(0,0,0,.1);
}

</style>

</head>

<body>

<div class="sidebar">

<div class="logo">

<i class="fa-solid fa-desktop"></i>

Inventario

</div>

<a href="{{route('dashboard')}}">

<i class="fa-solid fa-house"></i>

Dashboard

</a>

<a href="{{route('departments.index')}}">

<i class="fa-solid fa-building"></i>

Departamentos

</a>

<a href="{{route('personnel.index')}}">

<i class="fa-solid fa-users"></i>

Personal

</a>

<a href="{{route('locations.index')}}">

<i class="fa-solid fa-location-dot"></i>

Ubicaciones

</a>

<a href="{{route('equipment.index')}}">

<i class="fa-solid fa-computer"></i>

Equipos

</a>

<a href="{{route('components.index')}}">

<i class="fa-solid fa-microchip"></i>

Componentes

</a>

<a href="{{route('peripherals.index')}}">

<i class="fa-solid fa-keyboard"></i>

Periféricos

</a>

<a href="{{route('maintenance-records.index')}}">

<i class="fa-solid fa-screwdriver-wrench"></i>

Mantenimientos

</a>

<a href="{{route('hardware-changes.index')}}">

<i class="fa-solid fa-rotate"></i>

Cambios Hardware

</a>

<a href="{{route('reports.inventory')}}">

<i class="fa-solid fa-chart-column"></i>

Reportes

</a>

<form action="{{route('logout')}}" method="POST">

@csrf

<button class="btn btn-danger w-100 mt-4">

Cerrar Sesión

</button>

</form>

</div>

<div class="main">

<div class="topbar">

<h3>Sistema de Gestión de Inventario</h3>

</div>

@if(session('success'))

<div class="alert alert-success">

{{session('success')}}

</div>

@endif

@if($errors->any())

<div class="alert alert-danger">

<ul>

@foreach($errors->all() as $error)

<li>{{$error}}</li>

@endforeach

</ul>

</div>

@endif

@yield('content')

</div>

</body>

</html>