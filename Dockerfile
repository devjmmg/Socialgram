FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && rm -rf /var/lib/apt/lists/*

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instalar Node.js
COPY --from=node:20 /usr/local/bin/node /usr/local/bin/node
COPY --from=node:20 /usr/local/lib/node_modules /usr/local/lib/node_modules

RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Crear enlace simbólico para storage
RUN php artisan storage:link

# Publicar assets de Livewire
RUN php artisan livewire:publish --assets

# Instalar dependencias de JavaScript
RUN npm install

# Compilar assets de Vite para producción
RUN npm run build

# Ejecutar migraciones
# RUN php artisan migrate --force

# Asignar permisos
RUN chown -R www-data:www-data \
    /var/www/html/storage \
    /var/www/html/bootstrap/cache

# Configuración de Nginx
COPY conf/nginx/nginx-site.conf /etc/nginx/sites-available/default

# Puerto
EXPOSE 80

# Iniciar PHP-FPM y Nginx
CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]