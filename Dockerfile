FROM bref/php-83-fpm

WORKDIR web

RUN curl -s https://getcomposer.org/installer | php

RUN php composer.phar require bref/bref

RUN ls -lht

COPY . /var/task

RUN ls -lht /var/task

CMD _HANDLER=index.php /opt/bootstrap
