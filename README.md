# Bebidas-api

Este proyecto es una API desarrollada en Laravel para gestionar bebidas y las bebidas favoritas de los usuarios. Incluye autenticación de usuarios y manejo de imágenes.
Tiene como finalidad practicar la creacion y manejo de APIs en laravel y su posterior uso en framework/librerias front-end como React.

## Requisitos

- PHP >= 8.3
- Composer
- Laravel >= 11.x
- MySQL 

## Instalación

1. Clona el repositorio:
    ```bash
    git clone https://github.com/LeoSotomayor2001/bebidas-api.git
    cd bebidas-api
    ```

2. Instala las dependencias:
    composer install
3. Copia el archivo `.env.example` a `.env` y configura tus variables de entorno:
    ```bash
    cp .env.example .env
    ```

4. Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

5. Ejecuta las migraciones:
    ```bash
    php artisan migrate

## Uso

### Autenticación de Usuarios

- **Registro**: `POST /register`
- **Inicio de Sesión**: `POST /login`
- **Cerrar Sesión**: `POST /logout` (requiere autenticación)

### Gestión de Bebidas

- **Buscar Bebidas**: `GET /bebidas/search` (requiere autenticación)
- **Listar Bebidas**: `GET /bebidas` (requiere autenticación)
- **Crear Bebida**: `POST /bebidas` (requiere autenticación)
- **Mostrar Bebida**: `GET /bebidas/{bebida}` (requiere autenticación)
- **Actualizar Bebida**: `PUT /bebidas/{bebida}` (requiere autenticación)
- **Eliminar Bebida**: `DELETE /bebidas/{bebida}` (requiere autenticación)

### Gestión de Bebidas Favoritas

- **Listar Bebidas Favoritas del Usuario**: `GET /bebidas/favoritas-usuario` (requiere autenticación)
- **Añadir Bebida a Favoritas**: `POST /bebidas/{bebida}/favorita` (requiere autenticación)
- **Eliminar Bebida de Favoritas**: `DELETE /bebidas/{bebida}/favorita` (requiere autenticación)

### Manejo de Imágenes

- **Mostrar Imagen**: `GET /imagen/{filename}` 

## Contribuir

1. Haz un fork del proyecto.
2. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y haz commit (`git commit -am 'Añadir nueva funcionalidad'`).
4. Sube tus cambios (`git push origin feature/nueva-funcionalidad`).
5. Abre un Pull Request.
## Licencia

Este proyecto está bajo la licencia MIT. Ver el archivo LICENSE para más detalles.
