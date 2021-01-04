FROM ubuntu:18.04

RUN apt update && \
    apt-get -y install software-properties-common && \
    LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php -y && \
    apt update && \
    apt-get -y remove software-properties-common && \
    ## cleanup
    rm -r /var/lib/apt/lists/*

# install from repo
RUN apt update && \
    apt-get -y install php7.3-fpm php7.3-imagick && \
    ## cleanup
    rm -r /var/lib/apt/lists/*
