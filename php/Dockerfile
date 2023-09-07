# Imagen que se usara para la construccion de la imagen
FROM php:8.2-fpm-alpine

# Copy composer.lock and composer.json
# COPY composer.lock composer.json /var/www/

# Librerias que se instalaran durante la construccion de la imagen
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

# Argumentos para la construccion de la imagen
ARG WWW_INSTALL_PATH=/server
ARG APP=$WWW_INSTALL_PATH/app

# Creación de una carpeta
RUN mkdir -p ${WWW_INSTALL_PATH}

# Definiiendo la carpeta de trabajo
WORKDIR ${WWW_INSTALL_PATH}

# Eliminando cache
RUN rm -rf /var/cache/apk/lists/*

# Instalar y habilitar extensiones de PHP, incluyendo pdo_pgsql
RUN docker-php-ext-install pdo pdo_pgsql mbstring mysqli pdo_mysql zip exif pcntl gd

# Configurar la extensión GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Crea un grupo llamado "www" con GID 1000
# Crea un usuario llamado "www" con UID 1000, asignándolo al grupo "www"
RUN addgroup -g 1000 www
RUN adduser -u 1000 -D -h /home/www -s /bin/bash -G www www

# Establece el directorio de trabajo para la aplicación
WORKDIR ${APP}

# Establece los permisos para el usuario www
RUN chown -R www:www ${APP} && \
    chmod -R 755 ${APP}

# Cambiar usuario actual a www
USER www

# La imagen php:8.2-fpm-alpine expone el puerto para el 9000 por defecto
# Puerto expuesto comentado y configurando el puerto en zz-docker.conf
# EXPOSE 9200

CMD ["php-fpm"]