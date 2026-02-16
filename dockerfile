FROM php:8.2-cli

# Instala extensões necessárias
RUN docker-php-ext-install pdo pdo_mysql

# Copia todos os arquivos do projeto
COPY . /var/www/html/

# Permite uso de .htaccess (caso use rotas)
RUN a2enmod rewrite

EXPOSE 80
