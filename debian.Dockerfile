FROM php:7.3-fpm

# php imagick
# depends on apt-get install
RUN apt-get update && \
    apt install -y libmagickwand-dev --no-install-recommends && \
    pecl install imagick && \
    docker-php-ext-enable imagick && \
    ## cleanup
    rm -r /var/lib/apt/lists/* && \
    docker-php-source delete
