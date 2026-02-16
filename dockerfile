FROM php:8.2-apache

# Instala extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Copia os arquivos
COPY . /var/www/html/

EXPOSE 80
