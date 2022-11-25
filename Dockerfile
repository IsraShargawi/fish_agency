FROM composer:2.0 as build
WORKDIR /app/
COPY . .
RUN composer install --prefer-dist --no-dev --optimize-autoloader --no-interaction
ENV APP_DEBUG=false
RUN php artisan config:cache && \
    php artisan route:cache 

CMD ["php", "artisan", "serve"]