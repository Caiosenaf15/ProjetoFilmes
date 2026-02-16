FROM php:8.2-apache

# Instala apenas as extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Copia os arquivos do projeto
COPY . /var/www/html/

# Permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
