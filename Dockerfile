FROM bref/php-83-fpm

RUN curl -s https://getcomposer.org/installer | php

RUN php composer.phar require bref/bref

COPY web/pages /var/task/

COPY web/services /var/task/

COPY web/index.php /var/task/

CMD _HANDLER=index.php /opt/bootstrap
