# This container should be used for any/all CLI processes
# including cron, queues, etc.
FROM bkuhl/php:7.1

WORKDIR /var/www/html

# Copy the application files to the container
ADD --chown=www-data:www-data  . /var/www/html
RUN chmod 777 -R storage bootstrap/cache
USER www-data

huja kutas


# production-ready dependencies
RUN composer install  --no-interaction --optimize-autoloader --no-dev --prefer-dist
RUN rm -rf /home/www-data/.composer/cache
