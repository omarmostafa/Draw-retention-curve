# php-fpm
FROM php:7.3-fpm

CMD ["php-fpm"]

RUN curl -sL https://deb.nodesource.com/setup_11.x  | bash -

RUN apt update && apt install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
                zip \
                nodejs \
                npm \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && rm -r /var/lib/apt/lists/*


# Add a non-root user to prevent files being created with root permissions on host machine.
ARG PUID=1000
ARG PGID=1000
RUN groupadd -g $PGID temper && \
    useradd -u $PUID -g temper -m temper

#PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html

WORKDIR /var/www/html

RUN composer install

RUN rm -rf storage/framework
RUN rm -rf storage/framework/cache
RUN rm -rf storage/framework/views
RUN rm -rf storage/framework/sessions
RUN rm -rf storage/app
RUN rm -rf storage/logs

RUN mkdir storage/framework
RUN mkdir storage/framework/cache
RUN mkdir storage/framework/views
RUN mkdir storage/framework/sessions
RUN mkdir storage/app
RUN mkdir storage/logs

RUN chmod -R 777 storage/framework/cache/
RUN chmod -R 777 storage/framework/views/
RUN chmod -R 777 storage/framework/sessions/
RUN chmod -R 777 storage/app
RUN chmod -R 777 storage/logs


RUN chgrp www-data -R storage

EXPOSE 9000