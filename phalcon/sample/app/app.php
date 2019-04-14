<?php

use Phalcon\Mvc\Micro;

$app = new Micro();

$app->get('/', function() {
	echo "It works!";
});

$app->get('/phpinfo', function() {
	echo phpinfo();
});

$app->get('/container', function() {
	echo $_SERVER['HOSTNAME'];
});

$app->handle();
