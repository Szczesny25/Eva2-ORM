<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proyecto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .contenedor {
            background: #ffffff;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.15);
            width: 360px;
        }
        h1 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            box-sizing: border-box;
        }
        button {
            margin-top: 18px;
            width: 100%;
            padding: 10px;
            background-color: #1565c0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .errores {
            margin-top: 15px;
            padding: 10px;
            background-color: #ffebee;
            border: 1px solid #c62828;
            border-radius: 4px;
            font-size: 13px;
        }
        a {
            display: block;
            margin-top: 12px;
            text-align: center;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>Editar Proyecto</h1>

        @if ($errors->any())
            <div class="errores">
                <ul style="margin:0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('proyectos.actualizar', $proyecto->id) }}">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $proyecto->nombre) }}" required>

            <label for="fecha_inicio">Fecha de inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}" required>

            <label for="estado">Estado</label>
            <input type="text" name="estado" id="estado" value="{{ old('estado', $proyecto->estado) }}" placeholder="Ej: En curso" required>

            <label for="responsable">Responsable</label>
            <input type="text" name="responsable" id="responsable" value="{{ old('responsable', $proyecto->responsable) }}" required>

            <label for="monto">Monto</label>
            <input type="number" step="0.01" min="0" name="monto" id="monto" value="{{ old('monto', $proyecto->monto) }}" required>

            <button type="submit">Guardar cambios</button>
        </form>

        <a href="{{ route('proyectos.index') }}">← Volver a mis proyectos</a>
    </div>
</body>
</html>
