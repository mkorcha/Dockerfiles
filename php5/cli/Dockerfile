FROM alpine:3.3
MAINTAINER "Mike Korcha <mikekorcha@gmail.com>"

ENV PHP_VERSION     5.6.18
ENV PHALCON_VERSION 2.0.10

WORKDIR /tmp

# build php
RUN runtimeDeps=" \
		$PHP_EXTRA_RUNTIME_DEPS \
		curl \
		libmcrypt \
		libpq \
		libxml2 \
		libyaml@testing \
		readline \
		sqlite-libs \
	" && \
	buildDeps=" \
		$PHP_EXTRA_BUILD_DEPS \
		autoconf \
		curl-dev \
		g++ \
		libmcrypt-dev \
		libxml2-dev \
		libxslt-dev \
		libyaml-dev@testing \
		make \
		mariadb-dev \
		openssl-dev \
		pcre-dev \
		postgresql-dev \
		re2c \
		readline-dev \
		sed \
		tar \
		xz-dev \
	" \
	&& set -x \
	&& echo "@testing http://dl-4.alpinelinux.org/alpine/edge/testing/" >> /etc/apk/repositories \
	&& apk add --update $runtimeDeps $buildDeps \
	&& curl -fSL http://php.net/get/php-$PHP_VERSION.tar.gz/from/this/mirror -o php-$PHP_VERSION.tar.gz \
	&& tar -xf php-$PHP_VERSION.tar.gz \
	&& cd php-$PHP_VERSION \
    && ./configure \
		--with-config-file-path=/etc/php \
		$PHP_EXTRA_CONFIGURE_ARGS \
		--disable-cgi \
		--enable-cli \
		--enable-mysqlnd \
		--with-curl \
		--with-mcrypt \
		--with-openssl \
		--with-pdo-mysql \
		--with-pdo-pgsql \
		--with-readline \
		--with-zlib \
	&& make \
	&& make install \
	&& make clean \
	&& mkdir -p /etc/php \
	&& curl https://raw.githubusercontent.com/php/php-src/PHP-$PHP_VERSION/php.ini-production -o /etc/php/php.ini \
	&& pecl install apcu=4.0.10 mongo memcache redis yaml \
	&& echo extension=mongo.so >> /etc/php/php.ini \
	&& echo extension=memcache.so >> /etc/php/php.ini \
	&& echo extension=redis.so >> /etc/php/php.ini \
	&& echo extension=yaml.so >> /etc/php/php.ini \
	&& echo zend_extension=opcache.so >> /etc/php/php.ini \
	&& cd ../ \
	&& curl -L https://github.com/phalcon/cphalcon/archive/phalcon-v$PHALCON_VERSION.tar.gz -o phalcon-v$PHALCON_VERSION.tar.gz \
	&& tar -xf phalcon-v$PHALCON_VERSION.tar.gz \
	&& cd cphalcon-phalcon-v$PHALCON_VERSION/build \
	&& sh install \
	&& mv /tmp/cphalcon-phalcon-v2.0.10/build/64bits/modules/phalcon.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226/. \
	&& echo extension=phalcon.so >> /etc/php/php.ini 
	
WORKDIR /var/www

CMD ["php", "-a"]
