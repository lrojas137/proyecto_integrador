# Proyecto Integrador - Sistema Web Seguro de Gestión de Inventarios

## Descripción del proyecto

Este repositorio contiene el desarrollo del proyecto final integrador de la materia **Desarrollo de Aplicaciones Seguras**.  
El proyecto consiste en una aplicación web segura para la gestión de inventarios de **Distribuidora S.A.**, empresa dedicada a la distribución de productos de consumo masivo.

La aplicación fue desarrollada en **Laravel**, utilizando **MySQL** como base de datos y **Visual Studio Code** como entorno de desarrollo. El objetivo principal es aplicar los conceptos trabajados durante el semestre relacionados con ciclo de desarrollo seguro, autenticación, autorización, validación de datos, manejo de errores, logs, monitoreo, pruebas y gestión de incidentes.

---

## Objetivo

Desarrollar una aplicación web segura para la gestión de inventarios, aplicando buenas prácticas de desarrollo seguro de software, control de acceso por roles, validación de entradas, trazabilidad de movimientos, manejo adecuado de errores y procedimientos básicos de gestión de incidentes.

---

## Alcance

El sistema permite gestionar información relacionada con productos, categorías, proveedores y movimientos de inventario. También incorpora controles de seguridad para proteger el acceso a la aplicación, restringir funciones según el rol del usuario y registrar eventos relevantes para apoyar la trazabilidad y el monitoreo.

---

## Tecnologías utilizadas

- Laravel
- PHP
- MySQL
- XAMPP
- Composer
- Node.js y NPM
- Visual Studio Code
- Git y GitHub

---

## Módulos principales

### Autenticación

El sistema permite el registro, inicio de sesión y cierre de sesión de usuarios mediante Laravel Breeze. Las rutas internas se encuentran protegidas para evitar accesos no autorizados.

### Roles y permisos

Se implementaron tres roles principales:

- **Administrador:** acceso completo al sistema.
- **Operador:** gestión de productos, categorías, proveedores y movimientos de inventario.
- **Consulta:** acceso limitado a visualización de productos e historial autorizado.

### Categorías

Permite registrar, consultar, editar y desactivar categorías para organizar los productos del inventario.

### Proveedores

Permite registrar proveedores asociados a los productos, incluyendo información como nombre, NIT, teléfono, correo y dirección.

### Productos

Permite registrar productos con información como código, nombre, categoría, proveedor, descripción, stock, stock mínimo, precio y estado.

### Movimientos de inventario

Permite registrar:

- Entradas de productos.
- Salidas de productos.
- Ajustes de stock.

Cada movimiento guarda el usuario responsable, producto afectado, tipo de movimiento, cantidad, stock anterior, stock nuevo y observación.

### Monitoreo básico

El sistema cuenta con un panel de monitoreo para el administrador, donde se visualiza:

- Total de productos activos.
- Productos con stock bajo.
- Movimientos registrados en el día.
- Últimos movimientos de inventario.

---

## Controles de seguridad implementados

- Autenticación de usuarios.
- Hash de contraseñas.
- Control de acceso por roles mediante middleware.
- Protección de rutas internas.
- Validación de formularios.
- Uso de Eloquent ORM para evitar consultas SQL inseguras.
- Protección CSRF en formularios.
- Manejo controlado de errores.
- Páginas personalizadas para errores 403, 404, 419 y 500.
- Registro de eventos mediante logs.
- Trazabilidad de movimientos de inventario.
- Prevención de salidas mayores al stock disponible.
- Panel básico de monitoreo.

---

## Pruebas realizadas

Durante el desarrollo se realizaron pruebas funcionales, de autorización, validación y seguridad básica.

### Pruebas funcionales

- Inicio de sesión con usuario válido.
- Creación de categorías.
- Registro de proveedores.
- Creación de productos.
- Registro de entradas de inventario.
- Registro de salidas de inventario.
- Registro de ajustes de stock.
- Consulta de historial de movimientos.
- Visualización de productos con stock bajo.
- Consulta del panel de monitoreo.

### Pruebas de autorización

- Acceso permitido al administrador.
- Acceso permitido al operador en módulos autorizados.
- Acceso limitado para usuario de consulta.
- Bloqueo mediante error 403 para usuarios sin permisos.
- Redirección al login para usuarios no autenticados.

### Pruebas de validación

- Campos obligatorios.
- Correos inválidos.
- Códigos duplicados.
- Categorías duplicadas.
- Salidas mayores al stock disponible.
- Cantidades inválidas.

### Pruebas de seguridad básica

- SQL Injection en login.
- SQL Injection en formularios.
- XSS en campos de texto.
- Validación de protección CSRF.
- Acceso directo a rutas restringidas.
- Manejo seguro de errores con `APP_DEBUG=false`.

---

## Gestión de incidentes

Para la gestión de incidentes se utilizó GitHub Issues y GitHub Projects, con el fin de registrar, clasificar, priorizar y dar seguimiento a errores, vulnerabilidades y mejoras detectadas durante el desarrollo.

Ejemplos de incidentes registrados:

- Botón de nueva categoría no visible correctamente.
- Ruta `movimientos.index` no definida en el Dashboard.
- Salida mayor al stock mostraba pantalla técnica de Laravel.
- Usuario sin permisos intentando acceder al módulo de monitoreo.
- Producto con stock bajo en seguimiento.

Los incidentes fueron clasificados mediante etiquetas como:

- `bug`
- `seguridad`
- `mejora`
- `interfaz`
- `rutas`
- `manejo de errores`
- `prioridad alta`
- `prioridad media`
- `prioridad baja`

---

## Instalación y ejecución del proyecto

### 1. Clonar el repositorio

```bash
git clone https://github.com/lrojas137/proyecto_integrador.git
```

### 2. Ingresar a la carpeta del proyecto

```bash
cd proyecto_integrador
```

### 3. Instalar dependencias de PHP

```bash
composer install
```

### 4. Instalar dependencias de Node

```bash
npm install
```

### 5. Crear archivo de entorno

```bash
copy .env.example .env
```

En sistemas Linux o macOS:

```bash
cp .env.example .env
```

### 6. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 7. Configurar base de datos

Crear una base de datos en MySQL con el nombre:

```text
inventario_seguro_db
```

Luego configurar el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventario_seguro_db
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Ejecutar migraciones

```bash
php artisan migrate
```

### 9. Compilar recursos del frontend

```bash
npm run build
```

### 10. Ejecutar el servidor local

```bash
php artisan serve
```

La aplicación estará disponible en:

```text
http://127.0.0.1:8000
```

---

## Usuarios de prueba sugeridos

Después de crear un usuario desde el formulario de registro, se puede asignar el rol desde Tinker:

```bash
php artisan tinker
```

```php
$user = App\Models\User::where('email', 'admin@inventario.com')->first();
$user->role = 'admin';
$user->save();
```

Roles disponibles:

```text
admin
operador
consulta
```

---

## Estructura general del proyecto

```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── CategoriaController.php
│   │   ├── ProveedorController.php
│   │   ├── ProductoController.php
│   │   ├── MovimientoController.php
│   │   └── MonitorController.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   ├── Categoria.php
│   ├── Proveedor.php
│   ├── Producto.php
│   ├── Movimiento.php
│   └── User.php

database/
└── migrations/

resources/
└── views/
    ├── categorias/
    ├── proveedores/
    ├── productos/
    ├── movimientos/
    ├── monitoreo/
    └── errors/

routes/
└── web.php
```


