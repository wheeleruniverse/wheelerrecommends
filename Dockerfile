FROM bref/php-83-fpm

RUN curl -s https://getcomposer.org/installer | php

RUN php composer.phar require bref/bref

COPY web/pages/ /var/task/pages

COPY web/services/ /var/task/services

COPY web/index.php /var/task

RUN ls -lht /var/task

RUN ls -lht /var/task/pages

RUN ls -lht /var/task/services

CMD _HANDLER=index.php /opt/bootstrap
