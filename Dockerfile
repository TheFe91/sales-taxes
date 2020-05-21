FROM php:7.2-apache

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

RUN apt-get update --fix-missing
RUN apt-get install -y curl zsh nano
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && apt-get update && apt-get install -y git libzip-dev unzip \
    && docker-php-ext-install zip \
    && a2enmod rewrite headers \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# ZSH
RUN sh -c "$(curl -fsSL https://raw.github.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
RUN git clone https://github.com/zsh-users/zsh-syntax-highlighting.git ${ZSH_CUSTOM:-~/.oh-my-zsh/custom}/plugins/zsh-syntax-highlighting
RUN git clone https://github.com/zsh-users/zsh-autosuggestions $ZSH_CUSTOM/plugins/zsh-autosuggestions
RUN sed -i 's/ZSH_THEME="robbyrussell"/ZSH_THEME="avit"/g' ~/.zshrc
RUN sed -i 's/plugins=(git)/plugins=(git zsh-syntax-highlighting zsh-autosuggestions)/g' ~/.zshrc

# SYMFONY
COPY app/ /var/www/html/app/
COPY bin/ /var/www/html/bin/
COPY src/ /var/www/html/src/
COPY var/ /var/www/html/var/
COPY web/ /var/www/html/web/
COPY .gitignore /var/www/html/
COPY composer.json /var/www/html/
COPY composer.lock /var/www/html/
COPY README.md /var/www/html/
COPY LICENSE /var/www/html/

RUN usermod -u 1000 www-data

WORKDIR /var/www/html

#RUN composer install && php bin/console doctrine:schema:create && php bin/console assets:install