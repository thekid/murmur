FROM php:8.0-cli-alpine

RUN docker-php-ext-install -j$(nproc) bcmath

RUN apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/testing gnu-libiconv

ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

RUN curl -sSL https://baltocdn.com/xp-framework/xp-runners/distribution/downloads/e/entrypoint/xp-run-8.5.1.sh > /usr/bin/xp-run

RUN mkdir /app

COPY class.pth /app/

COPY src/main /app/src/main/

COPY vendor/ /app/vendor/

WORKDIR /app

EXPOSE 8080

CMD ["/bin/sh", "/usr/bin/xp-run", "xp.web.Runner", "-a", "0.0.0.0:8080", "-p", "prod", "-c", "src/main/etc/prod", "com.enbw.murmur.App"]