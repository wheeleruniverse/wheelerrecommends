FROM bref/php-83-fpm

RUN curl -s https://getcomposer.org/installer | php

RUN php composer.phar require bref/bref

COPY web /var/task

CMD _HANDLER=index.php /opt/bootstrap
