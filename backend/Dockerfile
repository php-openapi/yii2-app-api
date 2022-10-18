FROM yiisoftware/yii2-php:7.4-apache

# install git and unzip for composer install dist/source
RUN apt-get update && apt-get -y install git unzip mariadb-client && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY config/apache.conf /etc/apache2/sites-enabled/000-default.conf
