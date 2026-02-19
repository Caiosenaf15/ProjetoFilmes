FROM php:8.2-cli

# Instala extensões
RUN docker-php-ext-install pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copia composer primeiro (melhor prática)
COPY composer.json composer.lock ./

# Instala dependências
RUN composer install --no-dev --optimize-autoloader

# Copia o resto do projeto
COPY . .

WORKDIR /app/public

CMD php -S 0.0.0.0:$PORT
