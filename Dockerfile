###################################################
# Stage: base
#
# This base stage ensures all other stages are using the same base image
# and provides common configuration for all stages, such as the working dir.
###################################################
FROM node:24-alpine AS base

################## CLIENT STAGES ##################

###################################################
# Stage: client-base
#
# This stage is used as the base for the client-dev and client-build stages,
# since there are common steps needed for each.
###################################################
FROM base AS client-base
WORKDIR /usr/src/app

COPY ./client/package.json ./client/package-lock.json ./

RUN npm install

COPY ./client /usr/src/app

###################################################
# Stage: client-dev
#
# This stage is used for development of the client application. It sets
# the default command to start the Vite development server.
###################################################
FROM client-base AS client-dev
CMD ["npm", "run", "dev", "--", "--host"]

###################################################
# Stage: client-build
#
# This stage builds the client application, producing static HTML, CSS, and
# JS files that can be served by the backend.
###################################################
FROM client-base AS client-build
RUN npm run build

###################################################
################  BACKEND STAGES  #################
###################################################

# Use official PHP CLI image
FROM php:8.4-cli AS backend-dev

WORKDIR /var/www/html

# Install required system packages
RUN apt-get update && apt-get install -y \
    unzip git zip libzip-dev libicu-dev libonig-dev && \
    docker-php-ext-install intl mbstring zip mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Copy codebase on container working directory
COPY ./ /var/www/html

# Install PHP dependencies
RUN composer install

###################################################
# Stage: final
#
# This stage is intended to be the final "production" image. It sets up the
# backend and copies the built client application from the client-build stage.
###################################################
FROM backend-dev AS backend-build
WORKDIR /var/www/html
RUN composer install --no-dev
COPY --from=client-build /usr/src/app/dist ./public
 
# CMD ["php", "spark", "serve", "--host", "0.0.0.0", "--port", "8080"]
# EXPOSE 8080