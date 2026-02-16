FROM php:8.2-apache

# Desativa qualquer outro MPM
RUN a2dismod mpm_event || true
RUN a2dismod mpm_worker || true
RUN a2enmod mpm_prefork

# Instala PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copia projeto
COPY . /var/www/html/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
