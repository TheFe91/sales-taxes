FROM php:7.1.14-fpm

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN sed -i 's;http://archive.debian.org/debian/;http://deb.debian.org/debian/;' /etc/apt/sources.list
RUN apt-get -qq update -y && apt-get -qq install -y --no-install-recommends apt-utils

RUN apt-get install -qqy git curl wget unixodbc unixodbc-dev nano locate sudo unzip

RUN apt-get install -qqy \
    freetds-bin \
    freetds-dev \
    freetds-common \
    libct4 \
    libsybdb5 \
    tdsodbc \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng12-dev \
    libldap2-dev \
    zlib1g-dev \
    libc-client-dev \
    libxml2-dev \
    libcurl3-dev

COPY php.ini /usr/local/etc/php/
COPY www.conf /usr/local/etc/php-fpm.d/

RUN ln -s /usr/lib/x86_64-linux-gnu/libsybdb.a /usr/lib/ && \
    docker-php-ext-install pdo pdo_mysql pdo_dblib zip xml simplexml mcrypt ftp curl

RUN curl -sS https://getcomposer.org/installer | php && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

RUN echo "" >> ~/.bashrc && \
    export COMPOSER_ALLOW_SUPERUSER=1 && \
    export COMPOSER_MEMORY_LIMIT=-1 && \
    echo 'export PATH="~/.composer/vendor/bin:$PATH"' >> ~/.bashrc && \
    echo "alias composer='php -dmemory_limit=-1 /usr/local/bin/composer'" >> ~/.bashrc

RUN /usr/local/bin/composer global require hirak/prestissimo

COPY docker-entrypoint.sh /bin/docker-entrypoint.sh
RUN chmod +x /bin/docker-entrypoint.sh

WORKDIR /var/www

ENTRYPOINT [ "/bin/docker-entrypoint.sh" ]

CMD [ "php-fpm", "-R" ]

EXPOSE 9000