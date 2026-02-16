FROM php:8.2-cli

# Instala extensões
RUN docker-php-ext-install pdo pdo_mysql

# Define diretório
WORKDIR /app

# Copia arquivos
COPY . .

# Comando para rodar servidor
CMD php -S 0.0.0.0:$PORT
