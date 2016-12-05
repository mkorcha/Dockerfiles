docker-phalcon
==============

A small [Docker](https://www.docker.com/) container for PHP with the Phalcon framework installed.

Versions
--------

Two versions are maintained - one for PHP5 and one for PHP7. Both have the latest version of Phalcon installed. Tags are of the form $PHP_VERSION-$PHALCON_VERSION.

| tag                       | versions                   |
|---------------------------|----------------------------|
| `latest`, `7.0.13-3.0.2`  | PHP 7.0.13, Phalcon 3.0.2  |
| `5.6.28-3.0.2`            | PHP 5.6.28, Phalcon 3.0.2  |

What is PHP?
------------

>PHP is a popular general-purpose scripting language that is especially suited to web development.
> 
> Fast, flexible and pragmatic, PHP powers everything from your blog to the most popular websites in the world.

- [php.net](https://secure.php.net/)

What is Phalcon?
----------------

> A full-stack PHP framework delivered as a C-extension
> 
> Its innovative architecture makes Phalcon the fastest PHP framework ever built!

- [phalconphp.com](https://phalconphp.com/en/)

Why use this?
-------------

* You want a fast, lightweight PHP image (which is significantly smaller than the [official image](https://hub.docker.com/_/php/))
* You want to use the Phalcon framework without messing with compilation or PPAs
* Everything else is dockerized, why not this?

Image Usage
-----------

### Building

This image can be built by using the `build` script in the root of this repository. The PHP and Phalcon versions can be modified with the variables in the script.

### CLI

You can run this image as a PHP command line:

`docker run mkorcha/phalcon php somescript.php`

CLI phpinfo can be accessed via:

`docker run mkorcha/phalcon php -i`

All basic PHP command line tools are available.

### FPM

By default this image runs PHP-FPM. It uses similar configuration to that of the [official PHP image](https://hub.docker.com/_/php/). 

`docker run -d --name="php-fpm" -v .:/var/www mkorcha/phalcon`

You can also extend the image and place your project in the container directly, if you prefer.

Example
-------

A (very basic) sample project is available in the `sample` directory. To run it:

`docker-compose up`

Navigate to your local Docker machine at port 8080 in your browser and see the magic!
