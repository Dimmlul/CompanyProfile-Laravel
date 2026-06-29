FROM php:8.4-fpm

# install system deps + node
RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy source
COPY . .

# install deps (DEV mode, includes boost)
RUN composer install
RUN npm install

# optional: build once (vite still can run dev)
RUN npm run build || true

CMD ["php-fpm"]
