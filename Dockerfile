FROM php:8.1-apache

# Sistem paketlerini güncelle ve cURL'ü kur
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install curl

# Dosyaları kopyala
COPY . /var/www/html/

# Apache izinlerini ayarla
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/

# Apache portu
EXPOSE 80
