FROM ubuntu:18.04

RUN apt update && \
    apt-get -y install software-properties-common && \
    LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php -y && \
    apt update && \
    apt-get -y remove software-properties-common && \
    ## cleanup
    rm -r /var/lib/apt/lists/*

# install manually with pecl
RUN apt update && \
    apt-get -y install php7.3-fpm && \
    apt install -y libmagickcore-6.q16-2-extra libmagickcore-dev imagemagick libmagickwand-dev && \
    apt install -y gcc make autoconf libc-dev pkg-config && \
    apt install -y php-pear php7.3-dev php7.3-xml && \
    pecl install imagick && \
    echo extension=imagick.so > /etc/php/7.3/cli/conf.d/imagick.ini && \
    php -m | grep imagick && \
    ## cleanup
    rm -r /var/lib/apt/lists/*
