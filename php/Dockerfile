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

EXPOSE 4200

# La imagen php:8.2-fpm-alpine expone el puerto para el 9000 por defecto
# Puerto expuesto comentado y configurando el puerto en zz-docker.conf
# EXPOSE 9200

CMD ["php-fpm"]