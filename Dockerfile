FROM php:7.0.3

RUN apt-get update && apt-get install -y zip \
&& rm -rf /var/lib/apt/lists/*

COPY . /usr/src/myapp
WORKDIR /usr/src/myapp
RUN php composer-setup.php
RUN ./composer.phar install

CMD [ "php", "./scraper.php" ]
