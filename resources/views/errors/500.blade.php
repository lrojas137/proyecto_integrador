<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error interno</title>
</head>
<body style="background:#f3f4f6; font-family:Arial; display:flex; justify-content:center; align-items:center; min-height:100vh;">

    <div style="background:white; padding:32px; border-radius:8px; text-align:center; max-width:450px; box-shadow:0 1px 6px #ccc;">
        <h1 style="font-size:40px; color:#dc2626;">500</h1>
        <h2>Error interno del sistema</h2>
        <p style="color:#4b5563;">
            Ocurrió un problema inesperado. El evento será revisado por el administrador.
        </p>

        <a href="{{ route('dashboard') }}"
           style="background:#2563eb; color:white; padding:8px 16px; border-radius:6px; text-decoration:none;">
            Volver al Dashboard
        </a>
    </div>

</body>
</html>