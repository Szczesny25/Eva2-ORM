<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
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
            width: 320px;
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
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .exito {
            margin-top: 15px;
            padding: 10px;
            background-color: #e8f5e9;
            border: 1px solid #2e7d32;
            border-radius: 4px;
            font-size: 14px;
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
        <h1>Registro de Usuario</h1>

        @if ($errors->any())
            <div class="errores">
                <ul style="margin:0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('registro.guardar') }}">
            @csrf
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>

            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required>

            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" required>

            <button type="submit">Registrarse</button>
        </form>

        {{-- Información retornada por el controlador tras un registro exitoso --}}
        @if (isset($usuario))
            <div class="exito">
                Usuario registrado correctamente:<br>
                <strong>ID:</strong> {{ $usuario->id }}<br>
                <strong>Nombre:</strong> {{ $usuario->nombre }}<br>
                <strong>Correo:</strong> {{ $usuario->correo }}
            </div>
        @endif

        <a href="{{ route('login') }}">¿Ya tienes cuenta? Inicia sesión</a>
    </div>
</body>
</html>
