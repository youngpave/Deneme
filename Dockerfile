FROM php:8.1-apache
RUN apt-get update && apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev
RUN docker-php-ext-install curl
COPY . /var/www/html/
RUN chmod -R 755 /var/www/html/
EXPOSE 80
