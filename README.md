# Guía de configuración de proyecto PHP con Docker

Este es un ejemplo de configuración para ejecutar un proyecto PHP en contenedores Docker. Este proyecto consta de tres servicios principales: una aplicación PHP, un servidor web Nginx y un servidor de base de datos MariaDB. También se incluye PHPMyAdmin para gestionar la base de datos.

## Requisitos

Asegúrate de tener Docker y Docker Compose instalados en tu sistema antes de comenzar.

## Estructura de carpetas

Asegúrate de que tu estructura de carpetas se vea de la siguiente manera:

```Carpetas
proyecto-php-docker/
│
├── nginx/
│   ├── certs/
│   │   ├── server.crt
│   │   ├── server.key
│   │   └── Otras llaves y certificados de seguridad
│   │
│   ├── myphpwebsite.conf
│   └── nginx.conf
│
├── php/
│   ├── Dockerfile
│   ├── zz-docker.conf
│   ├── volumes.yml
│   ├── www.conf
│   └── Otros archivos de configuración para PHP
│
├── server/
│   ├── .devcontainer/
│   │   └── devcontainer.json
│   ├── controlador/
│   ├── core/
│   ├── modelo/
│   ├── vistas/
│   └── index.php
│
└── docker-compose.yml
```
# docker-compose.yml
```yml
version: "3.8"
services:
  # Nombre del servicio
  app:
    # Info para la contruccion de la imagen
    build:
      context: .
      # Dockerfile con las instrucciones de contrucción de la imagen de la app usando de base de la imagen php:8.2-fpm-alpine
      dockerfile: ./php/Dockerfile
    # Nombre del contenedor
    container_name: tecno_app
    restart: always
    volumes:
      # Redefinición del puerto de la imagen php:8.2-fpm-alpine 
      - ./php/zz-docker.conf:/usr/local/etc/php-fpm.d/zz-docker.conf
      # Configuración del php-fpm
      - ./php/www.conf:/usr/local/etc/php-fpm.d/www.conf
    # Extension de la configuracion del servicio
    extends:
      # Nombre del archivo del que extendera el servicio
      file: ./php/volumes.yml
      # Nombre del servicio del que extiende
      service: app_volumes
    # Servicios que se deben iniciar antes que tecno_app
    depends_on:
      - mariadb

  # Nombre del servicio
  nginx:
    # Imagen base del servicio
    image: nginx:1.25.2-alpine
    # Nombre del contenedor
    container_name: tecno_nginx
    restart: always
    # Configuracion de puertos de acceso host:container_network
    ports:
      - "80:80"
      - "443:443"
    volumes:
      # Configuración de los servidores web de nginx
      - ./nginx/myphpwebsite.conf:/etc/nginx/conf.d/default.conf
      # Configuracion principal nginx
      - ./nginx/nginx.conf:/etc/nginx/nginx.conf

      # LLaves y certificados para el https
      - ./nginx/certs/server.crt:/etc/nginx/ssl/server.crt
      - ./nginx/certs/server.key:/etc/nginx/ssl/server.key
      - ./nginx/certs/laravel.crt:/etc/nginx/ssl/laravel.crt
      - ./nginx/certs/laravel.key:/etc/nginx/ssl/laravel.key

  mariadb:
    # Imagen base del servicio
    image: mariadb:lts
    container_name: tecno_mariadb
    # Configuracion de puertos de acceso host:container_network
    ports: 
      - "3306:3306"
    environment:
      # Configuracion de variables de entorno de mariadb
      - MARIADB_ROOT_PASSWORD=root
      - MARIADB_DATABASE=dbtecno2023

  phpmyadmin:
    image: phpmyadmin:apache
    container_name: tecno_phpmyadmin
    # Configuracion de puertos de acceso host:container_network
    ports:
      - "8080:80"
    environment:
      # Configuracion de variables de entorno para la conexion con el servicio de mariadb
      - PMA_HOST=mariadb
      - PMA_PORT=3306
      - MYSQL_ROOT_PASSWORD=root
      - PMA_ARBITRARY=1
    # Servicios que se deben iniciar antes que tecno_phpmyadmin
    depends_on:
      - mariadb
```

## PHP Dockerfile (php/Dockerfile)

```Dockerfile
# Imagen base que se usará para la construcción de la imagen
FROM php:8.2-fpm-alpine

# Instalación de dependencias y herramientas
RUN apk update && apk add --no-cache \
    build-base \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    nodejs \
    bash \
    npm \
    vim \
    git \
    curl \
    zip \
    unzip \
    postgresql-dev \
    libexif-dev \
    libzip 

# Argumentos para la construcción de la imagen
ARG WWW_INSTALL_PATH=/server
ARG APP=$WWW_INSTALL_PATH/app

# Creación de una carpeta
RUN mkdir -p ${WWW_INSTALL_PATH}

# Establecimiento del directorio de trabajo
WORKDIR ${WWW_INSTALL_PATH}

# Eliminación de la caché
RUN rm -rf /var/cache/apk/lists/*

# Instalación y habilitación de extensiones de PHP, incluyendo pdo_pgsql
RUN docker-php-ext-install pdo pdo_pgsql mbstring mysqli pdo_mysql zip exif pcntl gd

# Configuración de la extensión GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Creación de un grupo llamado "www" con GID 1000
# Creación de un usuario llamado "www" con UID 1000, asignándolo al grupo "www"
RUN addgroup -g 1000 www
RUN adduser -u 1000 -D -h /home/www -s /bin/bash -G www www

# Establecimiento del directorio de trabajo para la aplicación
WORKDIR ${APP}

# Configuración de permisos para el usuario "www"
RUN chown -R www:www ${APP} && \
    chmod -R 755 ${APP}

# Cambio de usuario actual a "www"
USER www

# Comando para iniciar PHP-FPM
CMD ["php-fpm"]

```
## zz-docker.conf (php/zz-docker.conf)

```conf
[global]
daemonize = no

[www]
listen = 9200
## Contributing
```
