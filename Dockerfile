FROM php:8.2-cli

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /app

COPY . .

WORKDIR /app/public

CMD php -S 0.0.0.0:$PORT
