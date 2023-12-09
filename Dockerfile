FROM php:8.2-apache

WORKDIR /var/www/html

# Instalar dependências do Symfony
RUN apt-get update \
    && apt-get install -y unzip \
    && docker-php-ext-install pdo_pgsql

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiar arquivos do projeto
COPY . .

# Instalar dependências do Composer
RUN composer install --no-scripts --no-interaction

# Configurar o ambiente
COPY .env .env

EXPOSE 80
