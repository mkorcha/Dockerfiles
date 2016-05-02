docker-phalcon
==============

A small (under 50MB) [Docker](https://www.docker.com/) container for PHP with the Phalcon framework installed.

Tags
----

| tag                       | versions                   |
|---------------------------|----------------------------|
| `latest`, `5.6.21-2.0.10` | PHP 5.6.21, Phalcon 2.0.10 |
| `5.6.20-2.0.10`           | PHP 5.6.20, Phalcon 2.0.10 |
| `2.6.19-2.0.10`           | PHP 5.6.19, Phalcon 2.0.10 |

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

* You want a fast, lightweight PHP image (under 50MB with the entire base PHP installating, compared to the [official image](https://hub.docker.com/_/php/) being almost 500MB)
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
