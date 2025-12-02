# Hospital Laravel

Sistema de gestión hospitalaria desarrollado con Laravel 12. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre pacientes y usuarios.

## Requisitos del Sistema

- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Node.js y npm

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/Galfre77/Hospital_Laravel.git
cd Hospital_Laravel/hospital-Laravel
```

### 2. Instalar dependencias

```bash
composer install
npm install
```

### 3. Configurar el archivo de entorno

```bash
cp .env.example .env
php artisan key:generate
```

Editar el archivo `.env` con la configuración de la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 4. Configurar la base de datos

El proyecto incluye un archivo SQL listo para importar en la carpeta `bbdd/`. Para configurar la base de datos:

1. Crear la base de datos en MySQL/MariaDB o utilizar el archivo SQL que la crea automáticamente
2. Importar el archivo `bbdd/hospital.sql`:

```bash
mysql -u tu_usuario -p < bbdd/hospital.sql
```

O importar mediante phpMyAdmin u otra herramienta de gestión de bases de datos.

Este archivo SQL contiene:
- Estructura de tablas (paciente, usuarios, log_paciente, etc.)
- Datos de prueba para pacientes y usuarios
- Triggers para registro de actividad en log_paciente

### 5. Compilar assets

```bash
npm run build
```

### 6. Iniciar el servidor

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

## Funcionalidades CRUD

### Gestión de Pacientes
- **Crear**: Alta de nuevos pacientes con NIF, nombre, apellidos y fechas
- **Leer**: Consulta de pacientes registrados
- **Actualizar**: Modificación de datos de pacientes existentes
- **Eliminar**: Baja de pacientes del sistema

### Gestión de Usuarios
- Registro de usuarios
- Inicio de sesión / Cierre de sesión
- Recuperación de contraseña
- Roles de administrador

## Usuarios de Prueba

El archivo SQL incluye varios usuarios de prueba con diferentes roles (administrador y usuario estándar).

> **Nota**: Las contraseñas están hasheadas con bcrypt. Para probar el sistema, puedes:
> - Registrar un nuevo usuario desde la página de registro
> - Consultar la tabla `usuarios` en la base de datos para ver los emails disponibles
> - Actualizar la contraseña de un usuario existente mediante SQL

## Estructura del Proyecto

```
hospital-Laravel/
├── app/
│   ├── Http/Controllers/    # Controladores (PacienteController, usuarioController, vistaController, HomeController)
│   └── Models/              # Modelos (paciente, Usuario)
├── bbdd/
│   └── hospital.sql         # Script SQL para importar la base de datos
├── resources/
│   └── views/               # Vistas Blade
├── routes/
│   └── web.php              # Rutas de la aplicación
└── ...
```

## Licencia

Este proyecto utiliza el framework Laravel que está licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT).
