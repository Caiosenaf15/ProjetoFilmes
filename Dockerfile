FROM php:8.2-cli

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip pdo pdo_mysql \
    && apt-get clean

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copia apenas composer primeiro (melhor cache)
COPY composer.json composer.lock ./

# Instala dependências
RUN composer install --no-dev --optimize-autoloader

# Copia o resto do projeto
COPY . .

WORKDIR /app/public

CMD php -S 0.0.0.0:$PORT
