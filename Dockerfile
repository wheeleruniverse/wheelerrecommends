FROM bref/php-83-fpm

WORKDIR web

RUN curl -s https://getcomposer.org/installer | php

RUN php composer.phar require bref/bref

COPY . /var/task

RUN ls -lht

CMD _HANDLER=index.php /opt/bootstrap
