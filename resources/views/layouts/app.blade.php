<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistema de Inventario')</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Estilos adicionales -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: #2c3e50;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        #sidebar .sidebar-header {
            padding: 20px;
            background: #1a2a3a;
            text-align: center;
        }
        #sidebar .sidebar-header h3 {
            font-size: 1.3rem;
            margin: 0;
            color: #ecf0f1;
        }
        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #34495e;
        }
        #sidebar ul li a {
            padding: 12px 20px;
            font-size: 1rem;
            display: block;
            color: #ddd;
            text-decoration: none;
            transition: all 0.3s;
        }
        #sidebar ul li a:hover, #sidebar ul li a.active {
            background: #34495e;
            color: #fff;
        }
        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            background: #f8f9fa;
        }
        .navbar-custom {
            background: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .page-title {
            font-weight: 600;
            color: #2c3e50;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.05);
        }
        .table th {
            background: #f1f5f9;
            font-weight: 600;
        }
        .table-hover tbody tr:hover {
            background: #f8f9fa;
        }
        .pagination {
            justify-content: center;
        }
        .btn-sm i {
            margin-right: 4px;
        }
        .filter-section {
            background: #fff;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            margin-bottom: 20px;
        }
        .badge-status {
            font-size: 0.8rem;
            padding: 5px 10px;
        }
        .sidebar-active {
            background: #34495e;
            color: #fff !important;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><i class="fas fa-boxes"></i> Inventario</h3>
            </div>
            <ul class="list-unstyled components">
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="{{ route('departments.index') }}" class="{{ request()->routeIs('departments.*') ? 'active' : '' }}"><i class="fas fa-building"></i> Departamentos</a></li>
                <li><a href="{{ route('locations.index') }}" class="{{ request()->routeIs('locations.*') ? 'active' : '' }}"><i class="fas fa-map-marker-alt"></i> Ubicaciones</a></li>
                <li><a href="{{ route('equipment.index') }}" class="{{ request()->routeIs('equipment.*') ? 'active' : '' }}"><i class="fas fa-server"></i> Equipos</a></li>
                <li><a href="{{ route('components.index') }}" class="{{ request()->routeIs('components.*') ? 'active' : '' }}"><i class="fas fa-microchip"></i> Componentes</a></li>
                <li><a href="{{ route('peripherals.index') }}" class="{{ request()->routeIs('peripherals.*') ? 'active' : '' }}"><i class="fas fa-keyboard"></i> Periféricos</a></li>
                <li><a href="{{ route('maintenance-records.index') }}" class="{{ request()->routeIs('maintenance-records.*') ? 'active' : '' }}"><i class="fas fa-tools"></i> Mantenimientos</a></li>
                <li><a href="{{ route('hardware-changes.index') }}" class="{{ request()->routeIs('hardware-changes.*') ? 'active' : '' }}"><i class="fas fa-exchange-alt"></i> Cambios HW</a></li>
                <li><a href="{{ route('reports.inventory') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> Reportes</a></li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-custom">
                <div class="container-fluid">
                    <span class="navbar-brand page-title">@yield('page-title', 'Gestión')</span>
                    <div class="d-flex">
                        <span class="navbar-text me-3">
                            <i class="fas fa-user-circle"></i> Usuario
                        </span>
                        <a href="#" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i> Salir</a>
                    </div>
                </div>
            </nav>

            <!-- Mensajes flash -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts adicionales -->
    <script>
        // Confirmar eliminación
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Está seguro de eliminar este registro?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>