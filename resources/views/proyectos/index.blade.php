<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Proyectos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
        }
        .contenedor {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);
        }
        .encabezado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        h1 {
            font-size: 20px;
            margin: 0;
        }
        .acciones a, .acciones button {
            margin-left: 8px;
            text-decoration: none;
            background-color: #1565c0;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
        }
        .acciones button {
            background-color: #c62828;
        }
        .acciones .btn-swagger {
            background-color: #00897b;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e0e0e0;
            font-size: 14px;
        }
        th {
            background-color: #f5f5f5;
        }
        .vacio {
            margin-top: 20px;
            padding: 15px;
            background-color: #fff3e0;
            border: 1px solid #ef6c00;
            border-radius: 4px;
            font-size: 14px;
        }
        .estado {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            background-color: #e3f2fd;
            color: #1565c0;
        }
        .fila-acciones {
            white-space: nowrap;
        }
        .btn-editar, .btn-eliminar {
            display: inline-block;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            text-decoration: none;
            color: white;
        }
        .btn-editar {
            background-color: #2e7d32;
            margin-right: 6px;
        }
        .btn-eliminar {
            background-color: #c62828;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <div class="encabezado">
            <h1>Mis Proyectos</h1>
            <div class="acciones">
                <a href="{{ route('proyectos.crear') }}">+ Nuevo proyecto</a>
                <a class="btn-swagger" href="{{ url('api/documentation') }}" target="_blank" rel="noopener noreferrer">Ver Swagger</a>
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        </div>

        @if ($proyectos->isEmpty())
            <div class="vacio">
                Aún no tienes proyectos registrados. Crea el primero con "+ Nuevo proyecto".
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Estado</th>
                        <th>Responsable</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos as $proyecto)
                        <tr>
                            <td>{{ $proyecto->nombre }}</td>
                            <td>{{ $proyecto->fecha_inicio }}</td>
                            <td><span class="estado">{{ $proyecto->estado }}</span></td>
                            <td>{{ $proyecto->responsable }}</td>
                            <td>${{ number_format($proyecto->monto, 0, ',', '.') }}</td>
                            <td class="fila-acciones">
                                <a class="btn-editar" href="{{ route('proyectos.editar', $proyecto->id) }}">Editar</a>
                                <form action="{{ route('proyectos.eliminar', $proyecto->id) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar el proyecto \'{{ $proyecto->nombre }}\'? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>
