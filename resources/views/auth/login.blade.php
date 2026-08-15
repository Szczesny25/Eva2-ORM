<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
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
            background-color: #1565c0;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .exito {
            margin-top: 15px;
            padding: 10px;
            background-color: #e3f2fd;
            border: 1px solid #1565c0;
            border-radius: 4px;
            font-size: 13px;
            word-break: break-all;
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
        <h1>Inicio de Sesión</h1>

        @if ($errors->any())
            <div class="errores">
                <ul style="margin:0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (isset($error))
            <div class="errores">{{ $error }}</div>
        @endif

        <form method="POST" action="{{ route('login.autenticar') }}">
            @csrf
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo" value="{{ old('correo') }}" required>

            <label for="clave">Clave</label>
            <input type="password" name="clave" id="clave" required>

            <button type="submit">Ingresar</button>
        </form>

        {{-- Información retornada por el controlador: el usuario y su JWT --}}
        @if (isset($usuario) && isset($token))
            <div class="exito">
                <strong>Bienvenido, {{ $usuario->nombre }}</strong><br><br>
                <strong>Token JWT:</strong><br>
                {{ $token }}
                <br><br>
                <a href="{{ route('proyectos.index') }}">Ver mis proyectos →</a>
            </div>
        @endif

        <a href="{{ route('registro') }}">¿No tienes cuenta? Regístrate</a>
    </div>
</body>
</html>
