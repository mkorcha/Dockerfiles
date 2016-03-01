FROM alpine:3.3
MAINTAINER "Mike Korcha <mikekorcha@gmail.com>"

ENV PHP_VERSION    5.6.18
ENV PHALCON_COMMIT cf3c1fe

WORKDIR /tmp

# build php
RUN runtimeDeps=" \
		$PHP_EXTRA_RUNTIME_DEPS \
		curl \
		libmcrypt \
		libxml2 \
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
		make \
		openssl-dev \
		re2c \
		readline-dev \
		sed \
		tar \
		xz-dev \
	" \
	&& set -x \
	&& cat /etc/apk/repositories \
	&& apk update \
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
		--with-readline \
		--with-zlib \
	&& make \
	&& make install \
	&& make clean \
	&& { find /usr/local/bin /usr/local/sbin -type f -executable -exec strip --strip-all '{}' + || true; } \
	&& mkdir -p /etc/php \
	&& curl https://raw.githubusercontent.com/php/php-src/PHP-$PHP_VERSION/php.ini-production -o /etc/php/php.ini \
	&& apk del $buildDeps \
	&& rm -rf /tmp/* \
	&& rm -rf /var/cache/apk/* \
	
WORKDIR /var/www

CMD ["php", "-a"]
