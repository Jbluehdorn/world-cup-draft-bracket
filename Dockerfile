FROM node:10.4 as frontend
RUN mkdir -p /usr/src/app/resources
WORKDIR /usr/src/app

COPY package.json package-lock.json webpack.mix.js artisan ./
RUN npm i

COPY resources ./resources/
RUN npm run production

FROM cr.bcx.zone/bcx-docker/chassis:v1.7
LABEL maintainer="Jordan Bluehdorn <jbluehdorn@alphabytes.io>"

ENV PHP_MAX_INPUT_VARS 5000
COPY --from=frontend --chown=caddy:caddy /usr/src/app/public /srv/www/public