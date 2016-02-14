FROM alpine:3.3
MAINTAINER "Mike Korcha <mikekorcha@gmail.com>"

ENV PHP_VERSION    5.6.18
ENV PHALCON_COMMIT cf3c1fe

WORKDIR /tmp

# build php
RUN runtimeDeps=" \
		$PHP_EXTRA_RUNTIME_DEPS \
		libxml2 \
		sqlite-libs \
	" && \
	buildDeps=" \
		$PHP_EXTRA_BUILD_DEPS \
		autoconf \
		curl-dev \
		g++ \
		libxml2-dev \
		libxslt-dev \
		make \
		sed \
		re2c \
		tar \
	" \
	&& set -x \
	&& apk add --update $runtimeDeps $buildDeps \
	&& curl -fSL http://php.net/get/php-$PHP_VERSION.tar.gz/from/this/mirror -o php-$PHP_VERSION.tar.gz \
	&& tar -xf php-$PHP_VERSION.tar.gz \
	&& cd php-$PHP_VERSION \
	&& ./configure \
		--with-config-file-path=/etc/php \
		$PHP_EXTRA_CONFIGURE_ARGS \
		--disable-cgi \
		--enable-cli \
	&& make \
	&& make install \
	&& make clean \
	&& mkdir -p /etc/php \
	&& curl https://raw.githubusercontent.com/php/php-src/PHP-$PHP_VERSION/php.ini-production -o /etc/php/php.ini \
	&& apk del $buildDeps \
	&& rm -rf /tmp/*

CMD ["php", "-a"]
