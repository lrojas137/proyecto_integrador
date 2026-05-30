<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso no autorizado</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md text-center max-w-md">
        <h1 class="text-3xl font-bold text-red-600 mb-4">403</h1>
        <h2 class="text-xl font-semibold mb-2">Acceso no autorizado</h2>
        <p class="text-gray-600 mb-6">
            No tiene permisos para acceder a esta sección del sistema.
        </p>

        <a href="{{ route('dashboard') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Volver al Dashboard
        </a>
    </div>

</body>
</html>