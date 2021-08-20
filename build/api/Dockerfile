FROM php:7.4-apache

## Env vars
ENV API_DOCUMENT_ROOT /var/www/html/api/public
ENV APACHE_LOG_DIR /var/log/apache2

## vhosts activation 
ADD build/api/vhosts /etc/apache2/sites-available

## add activation 
RUN a2enmod rewrite


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get update && apt-get install -y libjpeg-dev

RUN  apt-get update \
  && apt-get install -y unzip \
                        zlib1g-dev \
                        libzip-dev \
                        libxrender1 \
                        libfontconfig1 \
                        libfreetype6 \
                        libssl-dev \
                        libpng-dev \
                        libjpeg-dev \
                        libpq-dev \
                        libicu-dev \
                        libbz2-dev \
                        wget \
                        strace \
                        locate \
                        apt-file \
                        vim \
                        git \
                        xvfb \
  && rm -rf /var/lib/apt/lists/* \
  && apt-get upgrade -y \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl pdo pdo_mysql mysqli \
  && docker-php-ext-install zip \
  && docker-php-ext-enable opcache



RUN apt-get update && apt-get install -y gnupg

RUN curl -sL https://deb.nodesource.com/setup_15.x | bash - && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && \
    apt-get install -qq -y build-essential nodejs yarn

RUN wget https://github.com/wkhtmltopdf/packaging/releases/download/0.12.6-1/wkhtmltox_0.12.6-1.buster_amd64.deb \
  && apt install -y ./wkhtmltox_0.12.6-1.buster_amd64.deb \
  && mv /usr/local/bin/wkhtmlto* /usr/bin/

RUN apt-get update \
    && apt-get install -y
## workdir
WORKDIR /var/www/html/api

####### service apache2 start
#CMD /usr/sbin/apache2ctl -D FOREGROUND
