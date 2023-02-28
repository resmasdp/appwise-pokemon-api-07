FROM php:8.1.16-apache

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql

# Copy the Laravel application files to the container
COPY . /var/www/html

# Set the working directory
WORKDIR /var/www/html

# Install Composer
RUN apt update
RUN apt install unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt upgrade -y


# Set file permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

#set root document
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Start the Apache server
CMD ["apache2-foreground"]

# Run migrations

RUN composer install
RUN php artisan key:generate

#Get certbot for SSL certificate
RUN apt install certbot python3-certbot-apache -y
