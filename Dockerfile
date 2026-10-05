FROM php:8.2-apache
WORKDIR /var/www/html
RUN docker-php-ext-install pdo pdo_mysql
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && echo 'default_charset = "UTF-8"' >> "$PHP_INI_DIR/php.ini" \
    && echo 'AddDefaultCharset UTF-8' > /etc/apache2/conf-enabled/charset.conf
COPY ./src/ /var/www/html/
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80
