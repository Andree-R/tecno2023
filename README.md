# Guía de configuración de proyecto PHP con Docker

Este es un ejemplo de configuración para ejecutar un proyecto PHP en contenedores Docker. Este proyecto consta de tres servicios principales: Una aplicación Angular & PHP, un servidor web Nginx y un servidor de base de datos MariaDB. También se incluye PHPMyAdmin para gestionar la base de datos.

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
├── client/
│   ├── .devcontainer/
│   │   └── devcontainer.json
│   ├── .angular/
│   ├── src/
│   ├── angular.json
│   ├── package-lock.json
│   ├── package.json
│   └── Otros archivos de configuración para angular
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
    # Comando para iniciar el servidor de angular en la red local con el puerto 4200 y el servidor php-fpm
    command: sh -c "ng serve --host 0.0.0.0 --port 4200 & php-fpm"
    restart: "no"
    volumes:
      # - ./php/php.ini:/usr/local/etc/php/conf.d/php.ini
      # - ./php/php.ini:/usr/local/etc/php/php.ini-production
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
    restart: "no"
    # Configuracion de puertos de acceso host:container_network
    ports:
      - "4200:4200"
      - "8181:80"
      - "450:443"
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
      - "3309:3306"
    environment:
      # Configuracion de variables de entorno de mariadb
      - MARIADB_ROOT_PASSWORD=root
      - MARIADB_DATABASE=dbtecno2023

  phpmyadmin:
    image: phpmyadmin:apache
    container_name: tecno_phpmyadmin
    # Configuracion de puertos de acceso host:container_network
    ports:
      - "9090:80"
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
# Imagen que se usara para la construccion de la imagen
FROM php:8.2-fpm-alpine

# Copy composer.lock and composer.json
# COPY composer.lock composer.json /var/www/

# Librerias que se instalaran durante la construccion de la imagen
RUN apk update && apk add --no-cache \
    linux-headers \
    php82-dev \
    automake \
    neofetch \
    autoconf \
    g++ \
    make \
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

ARG EXTENSIONS=/extensiones

RUN mkdir -p ${EXTENSIONS}
WORKDIR ${EXTENSIONS}

# Descargar Xdebug
RUN wget https://xdebug.org/files/xdebug-3.2.2.tgz && \
    tar -xvzf xdebug-3.2.2.tgz && \
    rm xdebug-3.2.2.tgz

# Cambiar al directorio Xdebug
WORKDIR /extensiones/xdebug-3.2.2

# Configurar Xdebug
RUN phpize && \
    ./configure && \
    make && \
    make install

# Habilitar Xdebug en la configuración de PHP
COPY ./php/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# Argumentos para la construccion de la imagen
ARG WWW_INSTALL_PATH_SERVER=/server
ARG APP_SERVER=${WWW_INSTALL_PATH_SERVER}/app_php

ARG WWW_INSTALL_PATH_CLIENT=/client
ARG APP_CLIENT=${WWW_INSTALL_PATH_CLIENT}/app_angular

ARG USER=www
ARG GROUP=www

# Creación de una carpeta
RUN mkdir -p ${WWW_INSTALL_PATH_SERVER}

# Definiiendo la carpeta de trabajo
WORKDIR ${WWW_INSTALL_PATH_SERVER}

# Eliminando cache
RUN rm -rf /var/cache/apk/lists/*

# Instalar y habilitar extensiones de PHP, incluyendo pdo_pgsql
RUN docker-php-ext-install pdo pdo_pgsql mbstring mysqli pdo_mysql zip exif pcntl gd

# Configurar la extensión GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Crea un grupo llamado "${GROUP}" con GID 1000
# Crea un usuario llamado "${USER}" con UID 1000, asignándolo al grupo "${GROUP}"
RUN addgroup -g 1000 ${GROUP}
RUN adduser -u 1000 -D -h /home/${USER} -s /bin/bash -G ${USER} ${GROUP}

# Establece el directorio de trabajo para la aplicación
WORKDIR ${APP_SERVER}

# Establece los permisos para el usuario ${USER}
RUN chown -R ${USER}:${GROUP} ${APP_SERVER} && \
    chmod -R 755 ${APP_SERVER}

WORKDIR ${WWW_INSTALL_PATH_CLIENT}

RUN npm install -g @angular/cli

COPY ../client ${APP_CLIENT}

WORKDIR ${APP_CLIENT}

RUN npm install

RUN chown -R ${USER}:${GROUP} ${APP_CLIENT} && \
    chmod -R 755 ${APP_CLIENT}

# Cambiar usuario actual a www
USER ${USER}

# Exponer el puerto para el servidor de angular
EXPOSE 4200

# La imagen php:8.2-fpm-alpine expone el puerto para el 9000 por defecto
# Puerto expuesto comentado y configurando el puerto en zz-docker.conf
# EXPOSE 9200

# Configurado por el docker compose
# CMD ["php-fpm"]

```
## zz-docker.conf (php/zz-docker.conf)

```conf
[global]
daemonize = no

# Puerto para el servidor php-fpm
[www]
listen = 9200
## Contributing
```
