FROM php:8.4-fpm

# system deps (Debian's own nodejs/npm packages drag in a huge, unrelated
# toolchain — eslint, typescript tooling, etc — as hard dependencies, not just
# recommends, so --no-install-recommends can't trim it. NodeSource's setup
# script installs just Node + npm, nothing else.)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev ca-certificates \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y --no-install-recommends nodejs \
    && docker-php-ext-install pdo_mysql mbstring bcmath gd \
    && rm -rf /var/lib/apt/lists/*

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# PHP deps — this layer only rebuilds when composer.json/composer.lock change,
# not on every source edit. --no-scripts skips package:discover, which needs
# the full app (artisan, bootstrap/) that isn't copied in yet.
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-interaction

# JS deps — same caching logic, keyed on package.json/package-lock.json.
COPY package.json package-lock.json ./
RUN npm install

# app source last: cheap COPY, no expensive RUN after it so cache invalidation
# here doesn't cost a reinstall. In dev this gets bind-mounted over anyway
# (see docker-compose.yml); copying it keeps the image runnable standalone too.
COPY . .

CMD ["php-fpm"]
