FROM bkuhl/fpm-nginx:laravel-fpm_v7.1

WORKDIR /var/www/html

# Copy the application files to the container
ADD --chown=www-data:www-data  . /var/www/html
RUN chmod 777 -R storage bootstrap/cache
# Run composer as www-data
USER www-data

# production-ready dependencies
RUN composer install  --no-interaction --optimize-autoloader --no-dev --prefer-dist
RUN rm -rf /home/www-data/.composer/cache
#RUN php artisan route:clear
RUN php artisan config:clear
#RUN php artisan cache:clear
#RUN php artisan config:cache
#
#RUN npm install
#RUN npm run install
#RUN npm cache clean

RUN pwd
RUN ls


# add vhost config
ADD ./infrastructure/web/default.conf /etc/nginx/conf.d/default.conf

USER root
#ENTRYPOINT ["sh","migration-script.sh"]
