# ---------- ETAPA 1: BUILD DE FRONT ----------
FROM node:20 AS node_builder
 
WORKDIR /app
 
COPY package*.json ./
RUN npm install
 
COPY . .
RUN npm run build
 
 
# ---------- ETAPA 2: PHP + NGINX ----------
FROM php:8.4-fpm
 
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    libpq-dev \
&& docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd
 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
 
WORKDIR /var/www
 
COPY . .
 
# Copiar assets ya compilados
COPY --from=node_builder /app/public/build /var/www/public/build
 
RUN composer install --no-dev --optimize-autoloader
 
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
 
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/entrypoint.sh /entrypoint.sh
 
RUN chmod +x /entrypoint.sh
 
EXPOSE 10000
 
CMD ["/entrypoint.sh"]