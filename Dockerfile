FROM bref/php-83-fpm

WORKDIR web

RUN curl -s https://getcomposer.org/installer | php

RUN php composer.phar require bref/bref

COPY pages/ /var/task/

COPY services/ /var/task/

COPY index.php /var/task/

CMD _HANDLER=/var/task/index.php /opt/bootstrap
