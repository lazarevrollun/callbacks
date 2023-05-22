FROM maxrollundev/php-fpm-dev-8.0

USER root

RUN apt-get update && apt-get install -y vim

# Install xdebug
#RUN pecl install xdebug-3.0.2 && docker-php-ext-enable xdebug

COPY ./php-fpm.conf  /usr/local/etc/php-fpm.conf
COPY ./conf.d  /usr/local/etc/php/conf.d

WORKDIR /var/www/app

CMD ["php-fpm", "-R"]