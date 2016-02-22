FROM php:5.6-fpm

RUN apt-get update \
    && apt-get install -y apt-utils git
RUN apt-get install -y curl libicu-dev zlib1g-dev redis-server \
    && docker-php-ext-install intl \
    && pecl install redis \
    && pecl install apcu-4.0.10 \
    && docker-php-ext-enable apcu \
    && docker-php-ext-enable redis \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

RUN usermod -u 1000 www-data

ADD src src
ADD tests tests
ADD tools tools
ADD docroot docroot
ADD composer.json composer.json
ADD phpunit.xml.dist phpunit.xml.dist
ADD behat.yml behat.yml

RUN composer -n global require hirak/prestissimo

ENV COMMERCETOOLS_CLIENT_ID="client_id" \
    COMMERCETOOLS_CLIENT_SECRET="client_secret" \
    COMMERCETOOLS_PROJECT="project_key"
RUN composer -n install --prefer-dist -o

ADD tools/60-user.ini /usr/local/etc/php/conf.d/
COPY tools/phpunit.sh /

ENTRYPOINT ["/phpunit.sh"]
