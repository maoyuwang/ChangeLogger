FROM       php
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
EXPOSE     8080

WORKDIR    /var/www/

ENTRYPOINT ["php", "-S", "0.0.0.0:8080"]
