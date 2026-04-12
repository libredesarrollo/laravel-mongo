# Laravel MongoDB - Sistema de Gestión de Libros y Eventos

![Laravel Version](https://img.shields.io/badge/Laravel-11.x-red)
![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue)
![MongoDB](https://img.shields.io/badge/MongoDB-Official-green)

Este proyecto es una aplicación moderna basada en **Laravel 11** que utiliza **MongoDB** como base de datos principal a través de la integración oficial de MongoDB para Laravel. Originalmente creado en 2021, el proyecto ha sido actualizado en 2026 para cumplir con los estándares actuales de rendimiento y seguridad.

## 🚀 Características

- **Arquitectura Moderna**: Actualizado a Laravel 11 con modelos en `App\Models`.
- **Integración MongoDB**: Uso de `mongodb/laravel-mongodb` para un soporte robusto de NoSQL.
- **Gestión de Libros**: CRUD completo con relaciones entre categorías y etiquetas (Tags).
- **Calendario de Eventos**: Integración con FullCalendar 5 para la gestión de fechas y eventos.
- **Autenticación**: Sistema de usuarios adaptado para MongoDB.
- **Frontend**: Estilizado con **Bootstrap 5** y FontAwesome 5.

## 📋 Requisitos Propios

- **PHP**: 8.2 o superior.
- **Extensión PHP**: `mongodb` (obligatoria).
- **MongoDB**: Servidor local o en la nube (Atlas).
- **Composer**: Para la gestión de dependencias PHP.
- **Node.js & NPM**: Para la compilación de assets.

## 🛠️ Instalación

1. **Clonar el repositorio**:
   ```bash
   git clone <url-del-repositorio>
   cd laravel-mongo
   ```

2. **Instalar dependencias**:
   ```bash
   composer install
   npm install
   ```

3. **Configuración del entorno**:
   Copia el archivo de ejemplo y configura tus credenciales de MongoDB:
   ```bash
   cp .env.example .env
   ```
   Asegúrate de ajustar las siguientes variables en tu `.env`:
   ```env
   DB_CONNECTION=mongodb
   DB_HOST=127.0.0.1
   DB_PORT=27017
   DB_DATABASE=laramongo
   # O usa DSN para MongoDB Atlas:
   # DB_DSN=mongodb+srv://user:pass@cluster.mongodb.net/dbname
   ```

4. **Generar la clave de la aplicación**:
   ```bash
   php artisan key:generate
   ```

5. **Compilar assets**:
   ```bash
   npm run dev
   ```

6. **Ejecutar el servidor**:
   ```bash
   php artisan serve
   ```

## 📂 Estructura de Modelos (MongoDB)

Los modelos se encuentran en `app/Models/` y utilizan el trait de Eloquent para MongoDB:

- **Book**: Gestión de títulos, precios y clasificaciones.
- **Category**: Categorización de libros.
- **Tag**: Etiquetas para filtrado avanzado.
- **Event**: Datos para el calendario dinámico.
- **User**: Usuarios del sistema.

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia [MIT](https://opensource.org/licenses/MIT).

Más información en

https://www.desarrollolibre.net/blog/laravel/curso-laravel

---
*Actualizado por Andres Cruz - 2026*
