FROM alpine:3.3
MAINTAINER "Mike Korcha <mikekorcha@gmail.com>"

ARG PHP_VERSION=5.6.23
ARG PHALCON_VERSION=2.0.13
ARG PHP_EXTRA_CONFIGURE_ARGS
ARG PHP_EXTRA_BUILD_DEPS
ARG PHP_EXTRA_RUNTIME_DEPS

WORKDIR /tmp

RUN runtimeDeps=" \
		$PHP_EXTRA_RUNTIME_DEPS \
		curl \
		libmcrypt \
		libpq \
		libtool \
		libxml2 \
		readline \
		sqlite-libs \
	" && \
	buildDeps=" \
		$PHP_EXTRA_BUILD_DEPS \
		autoconf \
		automake \
		curl-dev \
		findutils \
		g++ \
		libmcrypt-dev \
		libxml2-dev \
		libxslt-dev \
		make \
		mariadb-dev \
		openssl-dev \
		pcre-dev \
		postgresql-dev \
		re2c \
		readline-dev \
		sed \
		tar \
		unzip \
		xz-dev \
	" \
	&& set -x \
	&& echo "http://dl-4.alpinelinux.org/alpine/edge/testing/" >> /etc/apk/repositories \
	&& apk add --update $runtimeDeps $buildDeps \
	&& curl -fSL https://bitbucket.org/xi/libyaml/get/2b9156756423.zip -o libyaml.zip \
	&& unzip libyaml.zip \
	&& cd xi-libyaml-2b9156756423 \
	&& ./bootstrap && ./configure && make && make install && cd ../ \
	&& curl -fSL http://php.net/get/php-$PHP_VERSION.tar.gz/from/this/mirror -o php-$PHP_VERSION.tar.gz \
	&& tar -xf php-$PHP_VERSION.tar.gz \
	&& cd php-$PHP_VERSION \
    	&& ./configure \
		--with-config-file-path=/etc/php \
		$PHP_EXTRA_CONFIGURE_ARGS \
		--disable-cgi \
		--enable-cli \
		--enable-fpm \
		--enable-mysqlnd \
		--with-curl \
		--with-mbstring \
		--with-mcrypt \
		--with-openssl \
		--with-pdo-mysql \
		--with-pdo-pgsql \
		--with-readline \
		--with-zlib \
	&& make \
	&& make install \
	&& make clean \
	&& mkdir -p /etc/php /usr/local/etc/php-fpm.d \
	&& curl https://raw.githubusercontent.com/php/php-src/PHP-$PHP_VERSION/php.ini-production -o /etc/php/php.ini \
	&& cp /usr/local/etc/php-fpm.conf.default /usr/local/etc/php-fpm.d/www.conf \
	&& pecl install apcu-4.0.10 mongo memcache redis yaml \
	&& echo extension=apcu.so >> /etc/php/php.ini \
	&& echo extension=mongo.so >> /etc/php/php.ini \
	&& echo extension=memcache.so >> /etc/php/php.ini \
	&& echo extension=redis.so >> /etc/php/php.ini \
	&& echo extension=yaml.so >> /etc/php/php.ini \
	&& echo zend_extension=opcache.so >> /etc/php/php.ini \
	&& cd ../ \
	&& php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
	&& php composer-setup.php \
	&& php -r "unlink('composer-setup.php');" \
	&& mv /tmp/composer.phar /usr/local/bin/composer \
	&& chmod +x /usr/local/bin/composer \
	&& curl -L https://github.com/phalcon/cphalcon/archive/phalcon-v$PHALCON_VERSION.tar.gz -o phalcon-v$PHALCON_VERSION.tar.gz \
	&& tar -xf phalcon-v$PHALCON_VERSION.tar.gz \
	&& cd cphalcon-phalcon-v$PHALCON_VERSION/build \
	&& sh install \
	&& mv /tmp/cphalcon-phalcon-v$PHALCON_VERSION/build/64bits/modules/phalcon.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226/. \
	&& echo extension=phalcon.so >> /etc/php/php.ini \
	&& { find /usr/local/bin /usr/local/sbin -type f -executable -exec strip --strip-all '{}' + || true; } \
	&& { find /usr/local/lib -type f -name '*.so' -exec strip --strip-all '{}' + || true; } \ 
	&& apk del $buildDeps \
	&& rm -rf /tmp/* \
	&& rm -rf /var/cache/apk/* 

COPY php-fpm.conf   /usr/local/etc/
COPY docker.conf    /usr/local/etc/php-fpm.d/
COPY zz-docker.conf /usr/local/etc/php-fpm.d/

EXPOSE 9000

CMD ["php-fpm"]
