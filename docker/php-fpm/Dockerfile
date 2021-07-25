FROM php:7.4-fpm-alpine as production

# Install needed modules to run the application
RUN apk update \
 && apk --quiet add \
    libzip-dev

# Add php extension to work with zip files
RUN docker-php-ext-install -j$(nproc) \
    zip \
    pdo_mysql

WORKDIR /opt/app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy source code into container
COPY ./Api/ .

# Install production dependencies
RUN APP_ENV=prod composer install --no-dev

FROM production as development

RUN apk add -U --no-cache $PHPIZE_DEPS \
		php7-xdebug

RUN pecl install xdebug
RUN echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=\"/opt/app/var/log/xdebug.log\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN docker-php-ext-enable xdebug

ADD ./docker/php-fpm/devfs /

# Install dev dependencies
CMD sh -c "composer install && docker-php-entrypoint php-fpm"

EXPOSE 9000
