<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sesión expirada</title>
</head>
<body style="background:#f3f4f6; font-family:Arial; display:flex; justify-content:center; align-items:center; min-height:100vh;">

    <div style="background:white; padding:32px; border-radius:8px; text-align:center; max-width:450px; box-shadow:0 1px 6px #ccc;">
        <h1 style="font-size:40px; color:#dc2626;">419</h1>
        <h2>Sesión expirada</h2>
        <p style="color:#4b5563;">
            La sesión expiró o el formulario ya no es válido. Inicie sesión nuevamente.
        </p>

        <a href="{{ route('login') }}"
           style="background:#2563eb; color:white; padding:8px 16px; border-radius:6px; text-decoration:none;">
            Ir al login
        </a>
    </div>

</body>
</html>