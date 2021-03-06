# Для начала указываем исходный образ, он будет использован как основа
FROM php:7.1-fpm
# Необязательная строка с указанием автора образа
MAINTAINER vyalov.alexander@gmail.com

# RUN выполняет идущую за ней команду в контексте нашего образа.
# В данном случае мы установим некоторые зависимости и модули PHP.
# Для установки модулей используем команду docker-php-ext-install.
# На каждый RUN создается новый слой в образе, поэтому рекомендуется объединять команды.
RUN apt-get update && apt-get install -y \
        curl \
        wget \
        git \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        #libpng12-dev \
        libpq-dev \
    && docker-php-ext-install -j$(nproc) iconv mcrypt mbstring mysqli pdo_mysql pdo pdo_pgsql zip\
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install -j$(nproc) gd

#RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
#RUN docker-php-ext-install pdo pdo_pgsql
RUN pecl install mongodb

# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#COPY composer.json /var/www

COPY ./docker/php/docker-command.sh /docker-command.sh

# Указываем рабочую директорию для PHP
WORKDIR /var/www

# Добавим свой php.ini, можем в нем определять свои значения конфига
ADD ./docker/php/php.ini /usr/local/etc/php/conf.d/40-custom.ini

# Запускаем контейнер
# Из документации: The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable, 
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
#CMD ["php-fpm"]
