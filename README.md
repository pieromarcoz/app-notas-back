## Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- MySQL (u otro sistema de base de datos compatible con Laravel)

## Instalación

1. Clona el repositorio:
   ```
   git clone https://github.com/pieromarcoz/app-notas-back.git
   cd app-notas-back
   ```

2. Instala las dependencias de PHP:
   ```
   composer install
   ```

3. Copia el archivo de configuración:
   ```
   cp .env.example .env
   ```

4. Genera la clave de la aplicación:
   ```
   php artisan key:generate
   ```

5. Configura la base de datos en el archivo `.env`

6. Ejecuta las migraciones y los seeders:
   ```
   php artisan migrate --seed
   ```

## Desarrollo

Para iniciar el servidor de desarrollo:

```
php artisan serve
```

La API estará disponible en `http://localhost:8000`.

## Características Principales

- Autenticación con Laravel Sanctum
- Gestión de notas
- Control de acceso basado en roles con Spatie Laravel-permission

