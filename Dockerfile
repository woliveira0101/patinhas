# Usar a imagem oficial do PHP com Apache
# FROM arm64v8/php:8.3-apache
FROM php:8.3-apache

# Atualizar pacotes e instalar dependências
RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y wget vim git zip unzip zlib1g-dev libzip-dev libpng-dev libicu-dev

# Instalar extensões PHP necessárias
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql gd zip pcntl exif intl bcmath

# allow super user - set this if you use Composer as a
# super user at all times like in docker containers
ENV COMPOSER_ALLOW_SUPERUSER=1

# obtain composer using multi-stage build
# https://docs.docker.com/build/building/multi-stage/
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Here, we are copying only composer json and composer. lock (instead of copying the entire source
# right before doing composer install.
# This is enough to take advantage of docker cache and composer install will
# be executed only when composer json or composer. lock have indeed changed! -
# https://medium.com/@softius/faster-docker-builds-with-composer-install-b4d2b15d0fff
COPY ./composer.* ./

# install
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction

# Habilitar mod_rewrite para o Apache
RUN a2enmod headers expires rewrite

#RUN a2enmod status

# Copiar o arquivo de configuração para o container
# COPY status.conf /etc/apache2/conf-available/status.conf

# RUN a2enconf status

# Copiar a configuração do Apache para permitir o uso do .htaccess
COPY .docker/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Copiar o conteúdo do projeto para o container
COPY . /var/www/html/

# run composer dump-autoload --optimize
RUN composer dump-autoload --optimize

# Ajustar as permissões dos arquivos
RUN chown -R www-data:www-data /var/www/html

# Copiar o script de inicialização para o contêiner
COPY init.sh /init.sh

# Tornar o script de inicialização executável
RUN chmod +x /init.sh

# Iniciar o Apache usando o script de inicialização
# CMD ["/init.sh"]
ENTRYPOINT /bin/bash /init.sh