# Laravel MongoDB Project

Este es un proyecto de ejemplo que demuestra la integración de **Laravel 13** con **MongoDB** utilizando el driver oficial `mongodb/laravel-mongodb`. El proyecto incluye funcionalidades de CRUD, gestión de libros, categorías y una API REST para integración con FullCalendar.

## Características Principales

- **Integración con MongoDB**: Configuración completa para trabajar con bases de datos NoSQL.
- **Modelos Eloquent**: Uso de modelos de Laravel adaptados para MongoDB.
- **API REST**: Endpoints preparados para interactuar con aplicaciones frontend como FullCalendar.
- **Dashboard**: Panel de administración para la gestión de contenidos.

## Requisitos

- PHP 8.3+
- Extensión de PHP MongoDB (`ext-mongodb`)
- MongoDB Server instalado localmente o acceso a MongoDB Atlas.
- Composer

## Instalación

1.  **Clonar el repositorio:**
    ```bash
    git clone <url-del-repositorio>
    cd laravel-mongo
    ```

2.  **Instalar dependencias:**
    ```bash
    composer install
    ```

3.  **Configurar el entorno:**
    Copia el archivo `.env.example` a `.env` y configura tus credenciales de MongoDB:
    ```bash
    cp .env.example .env
    ```

    Asegúrate de que las variables de base de datos apunten a MongoDB:
    ```env
    DB_CONNECTION=mongodb
    DB_HOST=127.0.0.1
    DB_PORT=27017
    DB_DATABASE=tu_base_de_datos
    ```

4.  **Generar la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

5.  **Instalar la API (Laravel 11+):**
    ```bash
    php artisan install:api
    ```

6.  **Iniciar el servidor:**
    ```bash
    php artisan serve
    ```

## Recursos Educativos

Este proyecto forma parte del material educativo de **Desarrollo Libre**. Puedes encontrar el curso completo y más información en el siguiente enlace:

👉 [Curso de Laravel en Desarrollo Libre](https://www.desarrollolibre.net/blog/laravel/curso-laravel)

---
Desarrollado con ❤️ por [Desarrollo Libre](https://www.desarrollolibre.net)
