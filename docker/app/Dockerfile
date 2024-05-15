ARG PHP_VERSION=8.2.2
ARG PHP_IMAGE_TYPE=fpm
# Use the official PHP image as base
FROM php:${PHP_VERSION}-${PHP_IMAGE_TYPE}
LABEL maintainer="Ahatasham <ahatasham.csecu@gmail.com>"
ARG TIMEZONE="Asia/Dhaka"
ARG HTTP_PROXY=""

ARG HOST_ROOT_DIR="./codes/"
ARG CONTAINER_WORK_ROOT_DIR="/var/www/html"

ARG COMPOSER_HOME="/var/www/.composer"
ARG COMPOSER_VERSION="2.0.13"

ENV http_proxy="${HTTP_PROXY}"
ENV TZ="${TIMEZONE}"

# Set working directory
WORKDIR ${CONTAINER_WORK_DIR}
USER root

# Install system dependencies
RUN apt-get update && apt-get install -y \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql mbstring exif pcntl bcmath xml \
    && echo "-- proxy setup --" \
        && if [ ! -z "${HTTP_PROXY}" ]; then \
        pear config-set http_proxy "${HTTP_PROXY}" \
        ;fi


# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
    apt-get install -y nodejs

#USER www-data

COPY --chown=www-data:www-data ${HOST_ROOT_DIR}composer.* ${CONTAINER_WORK_ROOT_DIR}/

# Copy the application files
COPY --chown=www-data:www-data ${HOST_ROOT_DIR} ${CONTAINER_WORK_ROOT_DIR}

RUN ls -l ${CONTAINER_WORK_ROOT_DIR}
#USER root

RUN chown -R www-data:www-data ${CONTAINER_WORK_ROOT_DIR}

## Create a non-root user
#RUN useradd -ms /bin/bash klassroomUser

## Switch to the non-root user
#USER klassroomUser

# Run Composer install
RUN composer install --no-interaction --prefer-dist --optimize-autoloader && \
    echo "Composer install completed successfully"

##npm install
RUN npm install && \
    npm cache clean --force

USER root

RUN chmod -R ug+w bootstrap/ storage/

COPY --chown=www-data:www-data ./docker/app/docker-entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

# Set proper permissions for the application files
#RUN chown -R www-data:www-data /var/www/html

# Dump Composer autoload
#RUN composer dump-autoload --optimize --no-dev

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Expose port 9000
EXPOSE 9000

CMD ["php-fpm"]
